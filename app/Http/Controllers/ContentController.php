<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Content;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$contents = Book::findOrFail($id)->content;
//		return $contents;
		return view('pages.contents',compact('contents'))->with('id',$id);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$book = Book::findOrFail($id);
		return view('pages.contentCreate')->with("bookName", $book->name)->with("bookId", $id);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id,Request $request)
	{
		$validator = Validator::make($request->all(), [
        'chapter' => 'integer'
    ]);
		if ($validator->fails()) {
    	 return redirect()->action('ContentController@create',  ['bookId' => $id])
                				->withErrors($validator)
                      	->withInput();
    }
		else {
			$book = Book::findOrFail($id);
			$content = new Content;
			$content->name = $request->name;
			$content->chapter = $request->chapter;
			$content->content = str_replace("\r\n", "<br/>", $request->content);
			$book->content()->save($content);
			return $this->index($id);
		}
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
			->where('contents.chapter', $chapter)->first();
		return view('pages.showContent',compact('content_chap'))->with('id',$id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id,$chapter)
	{
		$content = DB::table('books_contents')
			->where('bookKey', $id)
			->join('contents', 'books_contents.contentKey', '=', 'contents.contentKey')
			->where('contents.chapter', $chapter)->first();
		return view('pages.contentEdit',compact('content'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $chapter,Request $request)
	{
		$content = $this->findContent($id,$chapter);
		$content->name =  $request->name;
		$content->content = $request->content;
		$content->chapter = $request->chapter;
		$content->type = $request->type;
		$content->save();
		return Redirect::action('ContentController@index',array($id));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,$chapter)
	{
		$content = $this->findContent($id,$chapter);
		$content->delete();
		return Redirect::action('ContentController@index',array($id));
	}

	public function findContent($bookId,$chapter){
		$content_chap = DB::table('books_contents')
			->where('bookKey', $bookId)
			->join('contents', 'books_contents.contentKey', '=', 'contents.contentKey')
			->where('contents.chapter', $chapter)->first();
		$content = Content::find($content_chap->contentKey);
		return $content;
	}

}
