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

    public function index($id){
        $id = Auth::id();
        $user = User::findOrFail($id);
        return $user;
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

    public function showProfile($id){
        $user = User::findOrFail($id);
        return $user;
    }


    public function resetPassword($id,$password){

    }


    public function imageUpload(){
        return view('profile.imageUpload');
    }

    public function imageSave(Request $request){
        $image = new Image();
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required'
        ]);
        $image->title = $request->title;
        $image->description = $request->description;
        if($request->hasFile('image')) {
            $file = Input::file('image');
            //getting timestamp
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

            $name = $timestamp. '-' .$file->getClientOriginalName();

            $image->filePath = $name;

            $file->move(public_path().'/images/', $name);
        }
//        return $image->filePath;
        $image->save();

        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->image = $image -> filePath;
        $user->save();
        return 'Image Uploaded Successfully';
    }

    public function notification() {
        $id = Auth::id();
        $user = User::find($id);
        $noti = $user->getNotifications($limit = null, $paginate = null, $order = 'desc');
        return view('profile.notification')->with('notifications', $noti);
    }

}
