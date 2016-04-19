<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use PhpSpec\Exception\Exception;

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
        try {
            $content_chap = DB::table('books_contents')
                ->where('book_id', $id)
                ->join('contents', 'books_contents.content_id', '=', 'contents.id')
                ->where('contents.chapter', $chapter)->first();
            if($content_chap->private && !$book->isOwner() && !Auth::user()->isAdmin())
                return redirect($this->getURI($id).'/'.$id)->with('status', 'You are not allowed.');
            return $next($request);
        }catch (\ErrorException $e){
            return redirect($this->getURI($id).'/'.$id);
        }
    }


    private function getURI($id){
        $book = Book::findOrfail($id);
        if($book->isComic())
            return 'comics';
        else
            return 'books';
    }
}
