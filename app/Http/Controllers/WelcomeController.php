<?php namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use App\Models\Tag;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		// $this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	
	public function welcome(){
		return view('welcome');
	}

	public function index(){
		$books = Book::all();
		$tags = Tag::all();

		$recentNovels = Book::where('category', 'Novel')->orderBy('updated_at', 'desc')->get();
		$recentComics = Book::where('category', 'Comic')->orderBy('updated_at', 'desc')->get();

		$topNovels = Book::where('category', 'Novel')->orderBy('userRating', 'desc')->get();
		$topComics = Book::where('category', 'Comic')->orderBy('userRating', 'desc')->get();
		return view('index', compact ('books', 'tags', 'topNovels', 'topComics', 'recentNovels', 'recentComics'));
	}
}
