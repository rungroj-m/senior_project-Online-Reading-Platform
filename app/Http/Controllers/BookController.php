<?php namespace App\Http\Controllers;

use App\Models\ContentInfo;
use App\Models\Book;
use App\Models\Content;
use App\Http\Requests;
use App\Models\User;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\BookReport;
use Validator;
use Request;
use DB;
use Auth;
use App\Models\Image;
use Input;
use Carbon\Carbon;
use Illuminate\Http\Request as ill;
use File;
use Route;
class BookController extends Controller {

	public function getURI($id = null){
		if($id) {
			$book = Book::findOrfail($id);
			if ($book->isComic())
				return 'comics';
			else
				return 'books';
		}
		else {
			$uri = Route::getCurrentRoute()->getPath();
			if ($uri == 'comics')
				return 'comics';
			else
				return 'books';
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$uri = Route::getCurrentRoute()->getPath();
		if($uri == 'comics')
			$books = Book::where('category','Comic')->get();
		else if($uri == 'books')
			$books = Book::where('category','Novel')->get();
//		$books = Book::all();
		return view('books.index',compact('books'));
	}

	public function search(){
		$requests = Request::get('request');

		if($requests == "" || $requests == null){
			$books = Book::all();
		}

		$dd = '';

		$ret = collect();

		foreach(explode(" ",$requests) as $request){

//			$request = str_replace(" ","",$request);

			$collection = collect();

			$books = Book::where(function ($query) use ($request){
				$query	->where('name', 'LIKE', '%'.$request.'%');
			})->get();

			$collection = $collection->merge($books);

//			return $collection;

			$tags = Tag::where('tag',$request)->get(array('id'));

			$book_tags = [];

			foreach ($tags as $tag){
				$book_tags =  DB::table('book_tags')->where('tag_id',$tag->id)->get(array('book_id'));
			}

//			return $book_tags;

			if($book_tags) {
				foreach ($book_tags as $tag) {
					$collection = $collection->push(Book::find($tag->book_id));
				}
			}

			$authors = User::where('username',$request)->get();

			foreach ($authors as $author){
				foreach ($author->books()->get() as $b){
					$collection = $collection->push($b);
				}
			}


			if($ret->isEmpty()){
				$ret = $collection;
			}
			else{
				$ret = $ret->intersect($collection);
			}

		}

//		return $ret;
		$books = $ret->unique()->values();
		return view('books.index', compact('books'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('books.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Request::all();
		$user = User::find(Auth::id());
		if($input['category'] == 'Comic' && !$user->isComicCreator())
			return redirect('/index');
		$book  = Book::create($input);
//		$book = '';
		$this->findOrCreateTag($input,$book);
		$book->save();
		$book -> user_id = Auth::id();
		$book->save();
		$book -> image = $this->saveimage($input);
		$book->save();
		return redirect($this->getURI($book->id));
	}

	public function findOrCreateTag($input,$book){

//		return '1';
//		return Tag::where('tag', 'fantasy')->get();

		if(Input::has('checkbox'))
			for($i = 0;$i<count($input['checkbox']);$i++){
				$checkbox = strtolower($input['checkbox'][$i]);
				if($checkbox){
					if(!Tag::where('tag',$checkbox)->get()->isEmpty()){
						// save it to book
						foreach (Tag::where('tag',$checkbox)->get() as $tb){
							$tb->books()->attach($book);
							$tb->save();
						}
					}else{
						// create new tag
						$tag = Tag::create();
						$tag->tag = $checkbox;
						$tag->save();
						$book->tags()->attach($tag);
						$book->save();
					}
				}
			}
		if(Input::has('tags')) {
			foreach (explode(" ", $input['tags']) as $t) {
				$t = strtolower($t);
				if (!Tag::where('tag', $t)->get()->isEmpty()) {
					// save it to book
					foreach (Tag::where('tag',$t)->get() as $tb){
						$tb->books()->attach($book);
						$tb->save();
					}
				} else {
					// create new tag
					$tag = Tag::create();
					$tag->tag = $t;
					$tag->save();
					$book->tags()->attach($tag);
					$book->save();
				}
			}
		}
	}

	public function saveimage($req){
		$request = new ill($req);
		$image = new Image();

		if(Input::file('image')) {
			$file = Input::file('image');
			$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
			$name = $timestamp. '-' .$file->getClientOriginalName();
			$image->filePath = $name;
			$file->move(public_path().'/images/', $name);
		}
		$image->save();
		return $image -> filePath;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$book = Book::findOrfail($id);
		$book->view_count++;
		$book->save();
		// if($book == null) {
		// 	return;
		// }
//		return Book::find($id)->user;


		return redirect($this->getURI($id).'/'.$id.'/content');
		// return $book;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$book = Book::findOrFail($id);
		if(!$book->isOwner())
			return redirect($this->getURI($id).'/'.$id);

		return view('books.edit',compact('book'));
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$book = Book::findOrFail($id);
		if(!$book->isOwner())
			return redirect($this->getURI($id).'/'.$id);

		$input = Request::all();
		$book->name = $input['name'];
		$book->description = $input['description'];
		$book->save();
		return redirect($this->getURI($id).'/'.$id.'/content');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$book = Book::findOrFail($id);
		if(!$book->isOwner())
			return redirect($this->getURI($id).'/'.$id);
		if($book->isOwner() || Auth::user()->isAdmin()) {
			$this->deleteContent($id);
			$book->contents()->detach();
			$this->deleteSubscription($book);
			$book->delete();
		}
		return redirect('index');
	}

	public function deleteContent($bookId){
		$content_chap = DB::table('books_contents')
			->select('content_id')
			->where('book_id', $bookId)
			->get();
		foreach($content_chap as $cid){
			$findContent = Content::find($cid->content_id);
			if($findContent != null)
				$findContent->delete();
		}
//		$content = Content::find($content_chap->contentKey);
	}

	public function deleteSubscription($book) {
		$subscription = $book->subscribers;
		foreach($subscription as $sub) {
			$sub->delete();
		}
	}

	public function alreadyRate($id){

		$userID = Auth::id();
		$book = Book::findOrFail($id);
		$book_id = $book->getKey();
		$condition = ['user_id' => $userID , 'book_id' => $book_id];
		$check = DB::table('ratings')->where($condition)->first();

		if($check == null)
			return false;
		return true;

	}

	public function rate($id){

		// if user already vote ( nothing happen )
		// else

		if($this->alreadyRate($id)){
			return redirect('books/'.$id);
		}

		$userID = Auth::id();

		$user = User::findOrfail($userID);

		$input = Request::all();
		$book = Book::findOrFail($id);

		// check user level if level == 0 -> basic user
		// if level == 1 -> critic user
		// level 2 -> admin

		// assume it pass data user vote

		if($user -> userLevel == '0' || $user -> userLevel == '2') {
			$book->userRating += $input['rating'];
//			$book->userRating += 4;
			$book->userRatingCount += 1;
			$book->save();
		}
		else{
			$book->criticRating += $input['rating'];
			$book->criticRatingCount += 1;
			$book->save();
		}

		$rating = new Rating();
		$rating -> book_id = $book->getKey();
		$rating -> user_id = $userID;
		$rating -> save();

		return redirect($this->getURI().'/'.$id);

	}

	public function report($id){
		$report = Request::get('report');
		$book = Book::findOrFail($id);
		$ownerId = Auth::id();
		$bookreport = BookReport::create();
		$bookreport -> type = $report;
		$bookreport -> book_id = $book->getKey();
		$bookreport -> user_id = $ownerId;
		$bookreport -> save();
		return redirect($this->getURI($id).'/'.$id);
	}

	public function showTotalReport($id){
		return $totalReport = DB::table('book_reports')->where('book_id','=',$id)->distinct('user_id')->count('user_id');
	}

}
