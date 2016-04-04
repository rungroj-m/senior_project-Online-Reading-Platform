<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->firstName = $request->firstName;
        $user->lastName  = $request->lastName;
        $user->username   = $request->username;
        $user->email      = $request->email;
        $user->userLevel  = $request->userLevel;
        $user->password   = bcrypt($request->password);

        $user->save();

        return redirect('/admin')->with('status', 'Create user ' + $user->username + ' succeed.');
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
        $user = User::find($id);
        return view('admin.user.edit')->with('user', $user);
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
      $user = User::find($id);

      $user->firstName = $request->firstName;
      $user->lastName  = $request->lastName;
      $user->email      = $request->email;

      $user->save();

      return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/admin')->with('status', 'Delete user no.'+$id+' succeed.');
    }

    public function bookReport(){
        $bookreport = DB::table('book_reports')->select(array('book_id','name',DB::raw('Count(book_id) as count')))->join('books','books.id','=','book_reports.book_id')->distinct('user_id')->groupby('book_id')->get();
        return view('admin.bookReport')->with('bookReport',$bookreport);
//        return $bookreport->count;
    }
}
