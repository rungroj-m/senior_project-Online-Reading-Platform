<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Feed;
use Carbon;
use App;
use App\Models\Content;
use DB;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feed = App::make("feed");
        $feed->setCache(60, 'recent-update');
        if (!$feed->isCached()) {
           // creating rss feed with our most recent 20 posts
           $contents = Content::orderBy('created_at', 'desc')->take(20)->get();
           // set your feed's title, description, link, pubdate and language
           $feed->title = 'Recent update contents';
           $feed->description = 'Feed for 20 recent updated contents.';
          //  $feed->logo = 'http://yoursite.tld/logo.jpg';
           $feed->link = url('feed');
           $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
           $feed->pubdate = Carbon\Carbon::now()->toDateTimeString();
           $feed->lang = 'en';
           $feed->setShortening(true); // true or false
           $feed->setTextLimit(100); // maximum length of description text

           foreach ($contents as $content) {
             $book = Book::find(DB::table('books_contents')->select('book_id')->where('content_id', $content->id)->first()->book_id);
             $user = $book->user;
            //  $user = $book->user;
             // set item's title, author, url, pubdate, description, content, enclosure (optional)*
             $feed->add($book->name, $user->username, url('books/'.$book->id.'/content/'.$content->chapter), $content->created_at, $content->chapter.' has been updated.', $content->content);
           }
        }

        // first param is the feed format
        // optional: second param is cache duration (value of 0 turns off caching)
        // optional: you can set custom cache key with 3rd param as string
        return $feed->render('rss');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
