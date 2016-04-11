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
        return view('donation.create', compact('user', 'books'));
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
          'amount' => 'required|numeric',
          'book' => 'required',
          'description' => 'required'
      ]);
      if ($validator->fails()) {
         return redirect()->action('DonationController@create_donation')
                          ->withErrors($validator)
                          ->withInput();
      }
      else {
        $book = Book::findOrFail($request->book);
        $user = User::findOrFail($request->owner);
        $donation = new Donation;
        $donation->user_id = $user->id;
        $donation->book_id = $book->id;
        $donation->description = $request->description;
        $donation->amount = $request->amount;
        $donation->user()->associate($user);
        $donation->book()->associate($book);
        $donation->save();
        return $this->show($id);
      }
    }

    public function store_pleading() {
      $validator = Validator::make($request->all(), [
          'amount' => 'required|numeric',
          'donation' => 'required'
      ]);
      if ($validator->fails()) {
         return redirect()->action('DonationController@create_pleading')
                          ->withErrors($validator)
                          ->withInput();
      }
      else {
        $donation = Donation::findOrFail($request->donation);
        $user = User::findOrFail($request->pleader);
        $pleading = new Pleading;
        $pleading->user_id = $user->id;
        $pleading->donation_id = $donation->id;
        $pleading->amount = $request->amount;
        $pleading->user()->associate($user);
        $pleading->donation()->associate($donation);
        $pleading->save();
        return $this->show($request->donation);
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
