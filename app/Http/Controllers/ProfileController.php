<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Input;
use App\Models\Image;
use Carbon\Carbon;
use Fenos\Notifynder\Models\Notification;
use Fenos\Notifynder\Models\NotificationCategory;
use DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $id = Auth::id();
        return $this->showProfile($id);
    }

    public function index(){
        $id = Auth::id();
        $user = User::findOrFail($id);

        $subscriptions = User::findOrFail($id)->subscriptions;
        $notifications = $this->notification();
        return view('profile.index', compact('user', 'notifications', 'subscriptions'));
    }

    public function showProfile($id){
        // if(Auth::user()->getKey() == $id){
        //     return redirect('profile');
        // }
        $user = User::findOrFail($id);

        return view('profile.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user -> firstName = $request -> firstName;
        $user -> lastName = $request -> lastName;
        $user -> email = $request -> email;
        $user->email_noti = $request->email_noti;
        $user->facebook_noti = $request->facebook_noti;
        $user -> save();
        return redirect('profile');
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

    public function resetPassword($id,$password){

    }


    public function imageSave(Request $request){
        $image = new Image();
        if($request->hasFile('image')) {
            $file = Input::file('image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $image->filePath = $name;
            $file->move(public_path().'/images/', $name);
        }
        $image->save();
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->image = $image -> filePath;
        $user->save();
        return redirect('/profile');
    }

    public function notification() {
        $id = Auth::id();
        $user = User::find($id);
        $noti = $user->getNotificationsNotRead($limit = null, $paginate = null, $order = 'desc');
//        $noti = $user->getNotifications($limit = null, $paginate = null, $order = 'desc');
        foreach($noti as $no) {
            $no->category = NotificationCategory::find($no->category_id);
            $temp = str_replace('{extra.bookname}', $no->extra->bookname, $no->category->text);
            $temp = str_replace('{extra.chaptername}', $no->extra->chaptername, $temp);
            $temp = str_replace('{extra.chapter}', $no->extra->chapter, $temp);

            $no->description = $temp;
        }
        return $noti;
        // return view('profile.notification')->with('notifications', $noti);
    }

    public function requestCreateComic()
    {
        $id = Auth::id();
        $user = User::find($id);
        if (!$user->isComicCreator() && !$user->isRequestComicCreator()) {
            $user->imageLevel = 2;
            $user->save();
        }
        return redirect('/comics');
    }

    public function preference() {
      $id = Auth::id();
      $user = User::find($id);
      return view('profile.preference', compact('user'));
    }

    public function update_preference(Request $request) {
      $id = Auth::id();
      $user = User::find($id);
      $user->email_noti = $request->email_noti;
      $user->facebook_noti = $request->facebook_noti;
      $user->save();
      return redirect(url('profile/preference'));
    }
}
