<?php namespace App\Http\Controllers;

use App\Models\ContentInfo;
use App\Models\Book;
use App\Models\Content;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Request;
use DB;
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
		return view('pages.books',compact('books'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('pages.create');
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
		$book = Book::find($id);
		if($book == null) {
			return;
		}
		return $book;
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
		return view('pages.edit',compact('book'));
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
		$book->userRating = $input['userRating'];
		$book->criticRating = $input['criticRating'];
		$book->category = $input['category'];
		$book->save();
		return redirect('books');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->DeleteContent($id);
		$book = Book::findOrFail($id);
		$book->content()->detach();
		$book->delete();
		return redirect('books');
	}

	public function DeleteContent($bookId){
		$content_chap = DB::table('books_contents')
			->select('contentKey')
			->where('bookKey', $bookId)
			->get();
		foreach($content_chap as $cid){
			Content::find($cid->contentKey)->delete();
		}
//		$content = Content::find($content_chap->contentKey);
	}

}
