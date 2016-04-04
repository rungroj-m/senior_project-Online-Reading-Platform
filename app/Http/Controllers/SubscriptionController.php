<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of subscribed book.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $subscribes = DB::table('subscriptions')->where('user_id', $user_id);
        return view('profile.subscription')->with('subscribes', $subscribes);
    }

    /**
     * subscribe a book.
     *
     * @param  int  $id of book to subscribe
     * @return \Illuminate\Http\Response
     */
    public function subscribe($id)
    {
        $user_id = Auth::id();
        $subscribe = DB::table('subscriptions')->select('id')->where('book_id', '=', $id)->where('user_id', '=', $user_id)->count() > 0;
        if($subscribe) {
          DB::table('subscriptions')
            ->where('user_id', $user_id)
            ->where('book_id', $id)
            ->update(['active' => true]);
        } else {
          $sub = new Subscription;
          $sub->active = true;
          $sub->user_id = $user_id;
          $sub->book_id = $id;
          $sub->save();
          // DB::table('subscriptions')->insert(
          //     ['user_id' => $user_id, 'book_id' => $id, 'active' => true]
          // );
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id of book to unsubscribe
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe($id)
    {
        $user_id = Auth::id();
        DB::table('subscriptions')
          ->where('user_id', $user_id)
          ->where('book_id', $id)
          ->update(['active' => false]);
        return redirect()->back();
    }
}
