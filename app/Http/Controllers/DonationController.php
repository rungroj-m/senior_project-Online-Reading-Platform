<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    /**
     * Display a listing of the donation and pleading.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_id = Auth::id();
      $user = User::findOrFail($user_id);
      $donations = $user->donations;
      $pleadings = $user->pleadings;
      return view('donation.index', compact('donations', 'pleadings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_donation()
    {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $books = $user->books;
        return view('donation.create_donation', compact('user', 'books'));
    }

    public function create_pleading() {
        $user_id = Auth::id();
        $user = User::findOrFail($user_id);
        $donations = Donation::all();
        return view('donation.create_pleading', compact('user', 'donations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_donation(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'goal_amount' => 'required|numeric'
      ]);
      if ($validator->fails()) {
         return redirect()->action('DonationController@create_donation')
                          ->withErrors($validator)
                          ->withInput();
      }
      else {
        // $book = Book::findOrFail($id);
        // $content = new Content;
        // $content->name = $request->name;
        // $content->chapter = $request->chapter;
        // $content->content = $request->content;
        // // $content->content = str_replace("\r\n", "<br/>", $request->content);
        // $book->contents()->save($content);
        //
        // // notify subscribed user
        // $this->notify($book, $content);
        //
        // return $this->index($id);
      }
    }

    public function store_pleading() {
      $validator = Validator::make($request->all(), [
          'amount' => 'required|numeric'
      ]);
      if ($validator->fails()) {
         return redirect()->action('DonationController@create_pleading')
                          ->withErrors($validator)
                          ->withInput();
      }
      else {
        // $book = Book::findOrFail($id);
        // $content = new Content;
        // $content->name = $request->name;
        // $content->chapter = $request->chapter;
        // $content->content = $request->content;
        // // $content->content = str_replace("\r\n", "<br/>", $request->content);
        // $book->contents()->save($content);
        //
        // // notify subscribed user
        // $this->notify($book, $content);
        //
        // return $this->index($id);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = Donation::findOrFail($id);
        $pleaders = $donation->plead;
        return view('donation.pleader', compact('donation', 'pleaders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        $pleaders = $donation->plead;
        return view('donation.edit', compact('donation', 'pleaders'));
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
