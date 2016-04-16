<?php namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use App\Models\BookReport;
use App\Jobs\SendNotificationEmail;
use Notifynder;
use App\Models\ContentInfo;
use App\Models\Image;
use Input;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Request as ill;
use File;
use App\Models\Book;
use App\Models\Content;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Facebook\Facebook;
use Auth;
use Session;
use Route;
use \XMLReader ;

class ContentController extends Controller {

	public function getURI($id){
		$book = Book::findOrfail($id);
		if($book->isComic())
			return 'comics';
		else
			return 'books';
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$route = Route::getCurrentRoute()->getPrefix();
		if($route == '/books/{book}')
			$checkURI = 'books';
		else if($route == '/comics/{book}')
			$checkURI = 'comics';
		if($this->getURI($id) != $checkURI)
			return redirect('index');

		$book = Book::findOrFail($id);
		$user_id = Auth::id();
		$owness = $book->isOwner();
		$contents = Book::findOrFail($id)->contents;
		$active = DB::table('subscriptions')->select('active')->where('book_id', '=', $id)->where('user_id', '=', $user_id)->get();
		$subscribe = 0;
		if(count($active) > 0) {
			$subscribe = $active[0]->active;
		}
		return view('contents.index',compact('contents', 'book', 'subscribe', 'owness', 'id'));
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$book = Book::findOrFail($id);
		if(!$book->isOwner())
			return redirect($this->getURI($id).'/'.$id);
		return view('contents.create',compact('book'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id,ill $request)
	{
		$book = Book::findOrFail($id);
		if(!$book->isOwner())
			return redirect($this->getURI($id).'/'.$id);

		$validator = Validator::make($request->all(), [
        'chapter' => 'required|numeric',
				'name' => 'required'
    ]);
		if(!$book->contents()->where('chapter',$request->chapter)->get()->isEmpty())
			return redirect()->action('ContentController@create',['bookId'=>$id])
				->withErrors("Chapter number already exists.")->withInput();
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
			$content->private = $request->private;
			if($book->isComic()) {
				$content->content = json_encode( $this->multiple_upload($request));
//				return $request;
			}
			else
				if($request['upload'])
					$content->content = $this->read_file_docx($request['upload']);
				else
					$content->content = $request->content;
			// $content->content = str_replace("\r\n", "<br/>", $request->content);
			$book->contents()->save($content);
			// notify subscribed user
			if($content->private == 0)
				$this->notify($book, $content);
			return redirect($this->getURI($id).'/'.$id);
		}
	}

	public function multiple_upload(Request $request) {
		// getting all of the post data

		$files = Input::file('images');
		// Making counting of uploaded images
		$file_count = count($files);
		// start count how many uploaded
		$uploadcount = 0;
		$locations = [];
		foreach($files as $file) {
			$image = new Image();
			$rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
			$validator = Validator::make(array('file'=> $file), $rules);
			if($validator->passes()){
				$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
				$name = $timestamp. '-' .$file->getClientOriginalName();
				$image->filePath = $name;
				$upload_success = $file->move(public_path().'/images/', $name);
				$image->save();
				$locations[$uploadcount] = $image->filePath;
				$uploadcount ++;
			}
		}
		Session::flash('success', 'Upload successfully');
		return $locations;
	}

	function read_file_docx($filename){
		if(!$filename || !file_exists($filename)) return false;

		$zip = zip_open($filename);

		if (!$zip || is_numeric($zip)) return false;

		while ($zip_entry = zip_read($zip)) {

			if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

			if (zip_entry_name($zip_entry) != "word/document.xml") continue;

		$content = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

		zip_entry_close($zip_entry);
		}// end while

		zip_close($zip);

		file_put_contents('temp.xml', $content);

		$xmlFile = "temp.xml";
		// set location of docx text content file
		$reader = new XMLReader;
		$reader->open($xmlFile);

		// set up variables for formatting
		$text = ''; $formatting['bold'] = 'closed'; $formatting['italic'] = 'closed'; $formatting['underline'] = 'closed'; $formatting['header'] = 0;

		// loop through docx xml dom
		while ($reader->read()){
			// look for new paragraphs
			if ($reader->nodeType == XMLREADER::ELEMENT && $reader->name === 'w:p'){
				// set up new instance of XMLReader for parsing paragraph independantly
				$paragraph = new XMLReader;
				$p = $reader->readOuterXML();
				$paragraph->xml($p);

				// search for heading
				preg_match_all('/<w:pStyle w:val="(Heading.*?[1-6])"/',$p,$matches);
				switch($matches[1]){
					case 'Heading1': $formatting['header'] = 1; break;
					case 'Heading2': $formatting['header'] = 2; break;
					case 'Heading3': $formatting['header'] = 3; break;
					case 'Heading4': $formatting['header'] = 4; break;
					case 'Heading5': $formatting['header'] = 5; break;
					case 'Heading6': $formatting['header'] = 6; break;
					default:  $formatting['header'] = 0; break;
				}

				// open h-tag or paragraph
				$text .= ($formatting['header'] > 0) ? '<h'.$formatting['header'].'>' : '<p>';

				// loop through paragraph dom
				while ($paragraph->read()){
					// look for elements
					if ($paragraph->nodeType == XMLREADER::ELEMENT && $paragraph->name === 'w:r'){
						$node = trim($paragraph->readInnerXML());

						// add <br> tags
						if (strstr($node,'<w:br ')) $text .= '<br>';

						// look for formatting tags
						$formatting['bold'] = (strstr($node,'<w:b/>')) ? (($formatting['bold'] == 'closed') ? 'open' : $formatting['bold']) : (($formatting['bold'] == 'opened') ? 'close' : $formatting['bold']);
						$formatting['italic'] = (strstr($node,'<w:i/>')) ? (($formatting['italic'] == 'closed') ? 'open' : $formatting['italic']) : (($formatting['italic'] == 'opened') ? 'close' : $formatting['italic']);
						$formatting['underline'] = (strstr($node,'<w:u ')) ? (($formatting['underline'] == 'closed') ? 'open' : $formatting['underline']) : (($formatting['underline'] == 'opened') ? 'close' : $formatting['underline']);

						// build text string of doc
						$text .=     (($formatting['bold'] == 'open') ? '<strong>' : '').
							(($formatting['italic'] == 'open') ? '<em>' : '').
							(($formatting['underline'] == 'open') ? '<u>' : '').
							htmlentities(iconv('UTF-8', 'ASCII//TRANSLIT',$paragraph->expand()->textContent)).
							(($formatting['underline'] == 'close') ? '</u>' : '').
							(($formatting['italic'] == 'close') ? '</em>' : '').
							(($formatting['bold'] == 'close') ? '</strong>' : '');

						// reset formatting variables
						foreach ($formatting as $key=>$format){
							if ($format == 'open') $formatting[$key] = 'opened';
							if ($format == 'close') $formatting[$key] = 'closed';
						}
					}
				}
				$text .= ($formatting['header'] > 0) ? '</h'.$formatting['header'].'>' : '</p>';
			}

		}
		$reader->close();

		// suppress warnings. loadHTML does not require valid HTML but still warns against it...
		// fix invalid html
		$doc = new \DOMDocument();
		$doc->encoding = 'UTF-8';
		@$doc->loadHTML($text);
		$goodHTML = simplexml_import_dom($doc)->asXML();
		return $goodHTML;
//		return 'a';
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
				if($user->email_noti) {
					$job = (new SendNotificationEmail($user, $book, $content))->onQueue('emails');
					$this->dispatch($job);
				}
				if($user->facebook_id>0 && $user->facebook_noti)
					$this->facebookNotification($user,$book);
			}
		}
	}

	/**
	 * Use this function to send notification to facebook user.
	 */
	public function facebookNotification($user,$book){

		$app_id = '811596832280396';
		$app_secret = '2f2e3fb44143bbf8543850d7cddc8c28';

		$fb = new Facebook([
			'app_id' => '{app-id}',
			'app_secret' => '{app-secret}',
			'default_graph_version' => 'v2.5',
		]);

//		$access_token = '811596832280396|RqbSrEt8yah1feLwm4OGKQo-5as';

		$access_token = $app_id.'|'.$app_secret;


		try{
			$response = $fb->post('/'.$user->facebook_id.'/notifications', ['template' => $book->name.' update new chapter.'], $access_token);
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
		$user_id = Auth::id();
		$content_chap = DB::table('books_contents')
			->where('book_id', $id)
			->join('contents', 'books_contents.content_id', '=', 'contents.id')
			->where('contents.chapter', $chapter)->first();
		$book = Book::findOrFail($id);
		if($book->isComic())
			return view('contents.show',compact('content_chap', 'book'))->with('id',$user_id)->with('content_images',json_decode($content_chap->content));
		return view('contents.show',compact('content_chap', 'book'))->with('id',$user_id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id,$chapter)
	{
		$book = Book::findOrFail($id);
		if(!$book->isOwner())
			return redirect($this->getURI($id).'/'.$id);

		$content = DB::table('books_contents')
			->where('book_id', $id)
			->join('contents', 'books_contents.content_id', '=', 'contents.id')
			->where('contents.chapter', $chapter)->first();
		$book = Book::findOrfail($id);
		return view('contents.edit',compact('content','book'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, $chapter,ill $request)
	{
		$book = Book::findOrFail($id);
		if(!$book->isOwner())
			return redirect($this->getURI($id).'/'.$id);

		$content = $this->findContent($id,$chapter);
		$content->name =  $request->name;
		$book = Book::findOrfail($id);
		if($book->isComic()) {
			$content->content = json_encode( $this->multiple_upload($request));
		}
		else{
			if($request['upload'])
				$content->content = $this->read_file_docx($request['upload']);
			else
				$content->content = $request->content;
		}
		$content->private =  $request->private;
		$content->chapter = $request->chapter;
		$content->save();
		return redirect($this->getURI($id).'/'.$id.'/content/'.$chapter);
//		return Redirect::action('ContentController@index',array($id));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,$chapter)
	{
		$book = Book::findOrFail($id);
		if(!$book->isOwner())
			return redirect($this->getURI($id).'/'.$id);

		$book = Book::find($id);
		if($book->isOwner() || Auth::user()->isAdmin()) {
			$content = $this->findContent($id, $chapter);
			$content->delete();
		}
		return redirect($this->getURI($id).'/'.$id);
//		return Redirect::action('ContentController@index',array($id));
	}

	public function findContent($bookId,$chapter){
		$content_chap = DB::table('books_contents')
			->where('book_id', $bookId)
			->join('contents', 'books_contents.content_id', '=', 'contents.id')
			->where('contents.chapter', $chapter)->first();
		$content = Content::find($content_chap->content_id);
		return $content;
	}

	public function contentNoti($bookId,$chapter,$notiID){
		$user = Auth::user();
		if(Notifynder::findNotificationById($notiID)->to_id == $user->id){
			$user->readNoti($notiID);
		}
		return redirect($this->getURI($bookId).'/'.$bookId.'/content/'.$chapter);
	}

}
