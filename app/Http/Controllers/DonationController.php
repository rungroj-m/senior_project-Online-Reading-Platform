<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Donation;
use App\Models\Pleading;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
      return view('donation.index', compact('donations', 'pleadings', 'user'));
    }

    public function getURI($id){
        $book = Book::findOrfail($id);
        if($book->isComic())
            return 'comics';
        else
            return 'books';
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
          'amount' => 'required|numeric|min:1',
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
        $donation->description = $request->description;
        $donation->goal_amount = $request->amount;
        $donation->active = $request->active;
        $donation->user()->associate($user);
        $donation->book()->associate($book);
        $donation->save();
        return redirect(url('donation/'.$donation->id));
      }
    }

    public function store_donation2($bookId,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect(url($this->getURI($bookId).'/'.$bookId))
                ->withErrors($validator);
        }
        else {
            $book = Book::findOrFail($bookId);
            $user = Auth::user();
            $donation = new Donation;
            $donation->description = $request->description;
            $donation->goal_amount = $request->amount;
            $donation->active = 1;
            $donation->user()->associate($user);
            $donation->book()->associate($book);
            $donation->save();
            return redirect(url($this->getURI($bookId).'/'.$bookId));
        }
    }

    public function store_pleading(Request $request) {
      $validator = Validator::make($request->all(), [
          'amount' => 'required|numeric|min:1',
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
        $pleading->amount = $request->amount;
        $pleading->user()->associate($user);
        $pleading->donation()->associate($donation);
        $pleading->save();
        return redirect(url('donation/'.$donation->id));
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

    public function edit_plead($id) {
      $plead = Pleading::findOrFail($id);
      $donation = $plead->donation;
      return view('donation.edit_pleading', compact('plead', 'donation'));
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
      $validator = Validator::make($request->all(), [
          'amount' => 'required|numeric|min:1',
      ]);
      if ($validator->fails()) {
        return redirect()->action('DonationController@edit', ['id' => $id])
                         ->withErrors($validator)
                         ->withInput();
      }
      else {
        $donation = Donation::find($id);
        $donation->description =  $request->description;
        $donation->goal_amount = $request->amount;
        $donation->active = $request->active;
        $donation->save();
        return redirect(url('donation/'.$donation->id));
      }
    }

    public function update_plead(Request $request, $id) {
      $validator = Validator::make($request->all(), [
          'amount' => 'required|numeric|min:1',
      ]);
      if ($validator->fails()) {
         return redirect()->action('DonationController@edit_plead', ['id' => $id])
                          ->withErrors($validator)
                          ->withInput();
      }
      else {
        $plead = Pleading::findOrFail($id);
        $plead->confirmed = $request->confirmed;
        $plead->amount = $request->amount;
        $plead->save();
        $donation = $plead->donation;
        return redirect(url('donation/'.$donation->id));
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Donation::destroy($id);
      return redirect(url('donation'))->with('status', 'Delete donation no.'.$id.' succeed.');
    }

    public function destroy_plead($id) {
      Pleading::destroy($id);
      return redirect(url('donation'))->with('status', 'Delete plead no.'.$id.' succeed.');
    }

    public function confirm_plead($id) {
      $plead = Pleading::findOrFail($id);
      $donation = $plead->donation;
      if($donation->user->id == Auth::id()) {
        $plead->confirmed = 1;
        $plead->save();
      } else {
        return redirect(url('donation/'.$donation->id))->with('status', 'You are not allow to confirm plead for this donation');
      }
      return redirect(url('donation/'.$donation->id));
    }

    public function unconfirm_plead($id) {
      $plead = Pleading::findOrFail($id);
      $donation = $plead->donation;
      if($donation->user->id == Auth::id()) {
        $plead->confirmed = 0;
        $plead->save();
      } else {
        return redirect(url('donation/'.$donation->id))->with('status', 'You are not allow to unconfirm plead for this donation');
      }
      return redirect(url('donation/'.$donation->id));
    }
}
