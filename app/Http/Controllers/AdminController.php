<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        $bookreports = DB::table('book_reports')->select(array('book_id','category','name',DB::raw('Count(book_id) as count')))->join('books','books.id','=','book_reports.book_id')->distinct('user_id')->groupby('book_id')->get();
        $commentreports = DB::table('comment_reports')->select(array('comment_reports.comment_id as id','comment',DB::raw('Count(comment_reports.comment_id) as count')))->join('comments','comments.id','=','comment_reports.comment_id')->distinct('user_id')->groupby('comment_reports.comment_id')->get();
        return view('admin.index',compact('users','bookreports','commentreports'));
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
        $user->imageLevel = $request->imageLevel;
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
      $user->userLevel = $request->userLevel;
      $user->imageLevel = $request->imageLevel;

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
        return redirect('/admin')->with('status', 'Delete user no.'.$id.' succeed.');
    }

    public function user(){
        $users = User::all();
        return view('admin.user.index')->with('users', $users);
    }

    public function bookReport(){
        $bookreport = DB::table('book_reports')->select(array('book_id','name',DB::raw('Count(book_id) as count')))->join('books','books.id','=','book_reports.book_id')->distinct('user_id')->groupby('book_id')->get();
        return view('admin.bookReport')->with('bookReport',$bookreport);
//        return $bookreport->count;
    }

    public function commentReport(){
        $commentreport = DB::table('comment_reports')->select(array('comment_reports.comment_id as id','comment',DB::raw('Count(comment_reports.comment_id) as count')))->join('comments','comments.id','=','comment_reports.comment_id')->distinct('user_id')->groupby('comment_reports.comment_id')->get();
        return view('admin.commentReport')->with('commentReport',$commentreport);
    }

    public function userRequest(){
        $users = User::where('imageLevel',2)->get();
        return view('admin.user.userRequest',compact('users'));
    }

    public function accept($id){
        $user = User::find($id);
        $user->imageLevel = 1;
        $user->save();
        return redirect('admin/userreport');
    }

}
