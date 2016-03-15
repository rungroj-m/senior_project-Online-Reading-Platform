<?php namespace App\Http\Controllers;

use App\Models\ContentInfo;
use App\Models\Book;
use App\Models\Content;
use App\Http\Requests;
use App\Models\User;
use App\Models\Rating;
use App\Http\Controllers\Controller;
use Validator;
use Request;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Collection;

class BookController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
		$books = Book::all();
		return view('books.index',compact('books'));
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
		Book::create($input);
		return redirect('books');

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


//		return $this->userVote($id);

		return Book::find($id)->user;
		return redirect('books/'.$id.'/content');
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
		return redirect('books/'.$id.'/content');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->deleteContent($id);
		$book = Book::findOrFail($id);
		$book->content()->detach();
		$book->delete();
		return redirect('books');
	}

	public function deleteContent($bookId){
		$content_chap = DB::table('books_contents')
			->select('contentKey')
			->where('bookKey', $bookId)
			->get();
		foreach($content_chap as $cid){
			$findContent = Content::find($cid->contentKey);
			if($findContent != null)
				$findContent->delete();
		}
//		$content = Content::find($content_chap->contentKey);
	}

	public function alreadyRate($id){

		$userID = Auth::id();
		$book = Book::findOrFail($id);
		$bookKey = $book->getKey();
		$condition = ['userKey' => $userID , 'bookKey' => $bookKey];
		$check = DB::table('ratings')->where($condition)->first();

		if($check == null)
			return false;
		return true;

	}

	public function rate($id){

		// if user already vote ( nothing happen )
		// else

		if($this->alreadyRate($id)){
			return 'already vote';
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

		return 'save complete';

	}

}
