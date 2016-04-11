<?php namespace App\Http\Controllers;

use App\Models\ContentInfo;
use App\Models\Book;
use App\Models\Content;
use App\Http\Requests;
use App\Models\User;
use App\Models\Rating;
use App\Models\Tag;
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
		$books = $ret->values();
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
		$book  = Book::create($input);
		$book -> user_id = Auth::id();
		$book->save();
		$book -> image = $this->saveimage($input);
		$book->save();
		return redirect($this->getURI($book->id));
	}

	public function saveimage($req){
		$request = new ill($req);
		$image = new Image();
		if(Input::file('image')) {
			$file = Input::file('image');
			//getting timestamp
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
		// $book = Book::find($id);
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
		if($book->isOwner() || Auth::user()->isAdmin()) {
			$this->deleteContent($id);
			$book->contents()->detach();
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

	public function alreadyRate($id){

		$userID = Auth::id();
		$book = Book::findOrFail($id);
		$bookKey = $book->getKey();
		$condition = ['user_id' => $userID , 'book_id' => $bookKey];
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
			$book->userRating += $input['userVote'];
//			$book->userRating += 4;
			$book->userRatingCount += 1;
			$book->save();
		}
		else{
			$book->criticRating += $input['userVote'];
			$book->criticRatingCount += 1;
			$book->save();
		}

		$rating = new Rating();
		$rating -> bookKey = $book->getKey();
		$rating -> userKey = $userID;
		$rating -> save();

		return redirect($this->getURI().'/'.$id);

	}

}
