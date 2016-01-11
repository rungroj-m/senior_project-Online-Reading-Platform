<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Content;
class ContentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$contents = Book::findOrFail($id)->content;
		return $contents;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		return view('pages.contentCreate')->with("bookId",$id);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id,Request $request)
	{
		$book = Book::findOrFail($id);
		$content = new Content;
		$content->name = $request->name;
		$content->chapter = $request->chapter;
		$content->content = $request->content;
		$book->content()->save($content);
		return $this->index($id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id, float $chapter
	 * @return Response
	 */
	public function show($id, $chapter)
	{
		$content_chap = DB::table('books_contents')
			->where('bookKey', $id)
			->join('contents', 'books_contents.contentKey', '=', 'contents.contentKey')
			->where('contents.chapter', $chapter);
		return $content_chap;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($bookid,$contentid)
	{

		$content = Content::findOrFail($contentid);
		return $content;
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
