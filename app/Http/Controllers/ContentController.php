<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Content;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Facebook\Facebook;
use Auth;
use App\Models\User;
use App\Models\BookReport;
use Log;
use Notifynder;

class ContentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$user_id = Auth::id();
		$contents = Book::findOrFail($id)->contents;
		$book = Book::findOrFail($id);
		$active = DB::table('subscriptions')->select('active')->where('book_id', '=', $id)->where('user_id', '=', $user_id)->get();
		$subscribe = true;
		if($active) {
			$subscribe = $active;
		}
		return view('contents.index',compact('contents', 'book', 'subscribe'))->with('id',$id);
	}

	public function report($id){
		$book = Book::findOrFail($id);
		$ownerId = Auth::id();
		$bookreport = BookReport::create();
		$bookreport -> type = 1;
		$bookreport -> book_id = $book->getKey();
		$bookreport -> user_id = $ownerId;
		$bookreport -> save();
		return redirect('books/'.$id);
	}

	public function showTotalReport($id){
		return $totalReport = DB::table('book_reports')->where('book_id','=',$id)->distinct('user_id')->count('user_id');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$book = Book::findOrFail($id);
		return view('contents.create')->with("bookName", $book->name)->with("bookId", $id);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id,Request $request)
	{
		$validator = Validator::make($request->all(), [
        'chapter' => 'required|integer|unique:contents',
				'name' => 'required'
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
			$content->content = $request->content;
			// $content->content = str_replace("\r\n", "<br/>", $request->content);
			$book->contents()->save($content);

			// notify subscribed user
			$this->notify($book, $content);

			return $this->index($id);
		}
	}

	/**
	 * Notify all user whom subscribe to specify book.
	 */
	protected function notify($book, $content) {
		$bookname = $book->name;
		$chapter = $content->chapter;
		$chaptername = $content->name;
		$subs = $book->subscribers;
		foreach($subs as $sub) {
			if($sub->active) {
				$user = $sub->user;
				Notifynder::category('book.updatechapter')
						->from('App\Models\Book', $book->id)
						->to('App\Models\User', $user->id)
						->url(url('/books'.'/'.$book->id.'/content'.'/'.$content->chapter))
						->extra(compact('bookname', 'chapter', 'chaptername'))
						->send();
			}
		}
	}

	/**
	 * Use this function to send notification to facebook user.
	 */
	public function facebookNotification($user_id){

		$app_id = '811596832280396';
		$app_secret = '2f2e3fb44143bbf8543850d7cddc8c28';

		$fb = new Facebook([
			'app_id' => '{app-id}',
			'app_secret' => '{app-secret}',
			'default_graph_version' => 'v2.5',
		]);

//		$access_token = '811596832280396|RqbSrEt8yah1feLwm4OGKQo-5as';

		$access_token = $app_id.'|'.$app_secret;

		$user = User::find($user_id);

		try{
			$response = $fb->post('/'.$user->facebook_id.'/notifications', ['template' => 'You have people waiting to play with you, play now!'], $access_token);
		}catch(Facebook\Exceptions\FacebookResponseException $e){
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		}catch(Facebook\Exceptions\FacebookSDKException $e) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
		$graphNode = $response->getGraphNode();
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
			->where('book_id', $id)
			->join('contents', 'books_contents.content_id', '=', 'contents.id')
			->where('contents.chapter', $chapter)->first();
		$book = Book::findOrFail($id);
		return view('contents.show',compact('content_chap', 'book'))->with('id',$id);
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
			->where('book_id', $id)
			->join('contents', 'books_contents.content_id', '=', 'contents.id')
			->where('contents.chapter', $chapter)->first();
		return view('contents.edit',compact('content'));
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
			->where('book_id', $bookId)
			->join('contents', 'books_contents.content_id', '=', 'contents.id')
			->where('contents.chapter', $chapter)->first();
		$content = Content::find($content_chap->content_id);
		return $content;
	}

}
