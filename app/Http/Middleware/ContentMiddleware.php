<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class ContentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->book;
        $chapter = $request->chapter;
        $book = Book::find($id);
        $content_chap = DB::table('books_contents')
            ->where('book_id', $id)
            ->join('contents', 'books_contents.content_id', '=', 'contents.id')
            ->where('contents.chapter', $chapter)->first();
        if($content_chap->private && !$book->isOwner() && !Auth::user()->isAdmin())
            return redirect('books/'.$id)->with('status', 'You are not allowed.');
        return $next($request);
    }
}
