<?php namespace App\Http\Controllers;

use App\Models\ContentInfo;
use App\Models\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;


class BookController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $books = ContentInfo::all();

		// $book1 = new ContentInfo;
		// $book1->name = 'Example1';
		// $book1->description = 'desc1';
		// $book1->userRating = 5;
		// $book1->criticRating = 5;
		// $book1->category = 'Action';

//		 $book2 = new ContentInfo;
//		 $book2->name = 'Example2';
//		 $book2->description = 'desc2';
//		 $book2->userRating = 1;
//		 $book2->criticRating = 1;
//		 $book2->category = 'Horror';
		// $books = [
		// 		$book1, $book2
		// ];
		// return view('pages.books', compact('books'));

		// $books = ContentInfo::all(); 
		// try{
		// $book = new Book;
		$books = ContentInfo::all();
		return view('pages.books',compact('books'));
		// $books = [
		// 		$book1,$book1
		// ];
		// $book->contentKey = $book1-> contentKey;
		// $book->save();
		// }
		// catch(Exception $e){
		// 	echo $e->getMessage();
		// }
		// return view('pages.books', compact('books'));
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
		ContentInfo::create($input);
		return redirect('books');
//		return $input;
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$book = ContentInfo::findOrFail($id);
		$books = [$book];
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
