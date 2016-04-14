<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Book;
use App\Models\Comment;
use App\Models\CommentRating;
use App\Models\CommentReport;
use Auth;
use DB;

class commentController extends Controller
{
    /**
     * Init comment.
     */
    public function postComment($bookId){
        $book = Book::findOrFail($bookId);
        $ownerId = Auth::id();
        $input = Request::all();
        $comment = Comment::create($input);
        $comment -> book_id = $book->getKey();
        $comment -> user_id = $ownerId;
        $comment -> save();
        return redirect($this->getURI($bookId).'/'.$bookId);
    }

    public function getComment($bookId){
        $book = Book::findOrFail($bookId);
        return Comment::with(['user_id','comment','rating'])->where('book_id'==$book->getKey());

//        $book_comments = DB::table('comments')
//            ->where('bookKey',$book->getKey())
//            ->orderBy('created_at', 'desc')->get();
//        return $book_comments;

    }

    /**
     * replied comment
     */
    public function repliedComment($bookId,$commentKey){
        $book = Book::findOrFail($bookId);

        $ownerId = Auth::id();
        $input = Request::all();
        $comment = Comment::create($input);
        $comment -> book_id = $book->getKey();
        $comment -> user_id = $ownerId;
        $comment -> comment_id = $commentKey;
        $comment -> save();
        return redirect($this->getURI($bookId).'/'.$bookId);
    }

//    public function nodeComment($book_comments,$parentKey){
//        foreach($book_comments as $comment){
//            if($comment -> ownerKey == $parentKey){
//                return nodeComment($book_comments,$comment->getKey());
//            }
//
//        }
//    }

    public function report($bookId,$commentId){
        $comment = Comment::findOrfail($commentId);
        $ownerId = Auth::id();
        $commentReport = CommentReport::create();
        $commentReport -> type = 1;
        $commentReport -> comment_id = $comment->getKey();
        $commentReport -> user_id = $ownerId;
        $commentReport -> save();
        return redirect($this->getURI($bookId).'/'.$bookId);
    }

    public function showTotalReport($bookId,$id){
        return $totalReport = DB::table('comment_reports')->where('comment_id','=',$id)->distinct('user_id')->count('user_id');
    }


    public function alreadyRate($commentKey){
        $userID = Auth::id();
        $condition = ['user_id' => $userID , 'comment_id' => $commentKey];
        $check = DB::table('commentRatings')->where($condition)->first();
        if($check == null)
            return false;
        return true;

    }

    public function voteUpComment($bookId,$commentKey){
        if($this->alreadyRate($commentKey))
            return redirect($this->getURI($bookId).'/'.$bookId);
        $userID = Auth::id();
        $comment = Comment::findOrfail($commentKey);
        $comment -> rating ++;
        $comment -> save();

        $commentRating = new CommentRating();
        $commentRating -> comment_id = $commentKey;
        $commentRating -> user_id = $userID;
        $commentRating -> save();
        return redirect($this->getURI($bookId).'/'.$bookId);
//        return 'voteup success';
    }

    public function voteDownComment($bookId,$commentKey){
        if($this->alreadyRate($commentKey))
            return redirect($this->getURI($bookId).'/'.$bookId);
        $userID = Auth::id();
        $comment = Comment::findOrfail($commentKey);
        $comment -> rating --;
        $comment -> save();

        $commentRating = new CommentRating();
        $commentRating -> comment_id = $commentKey;
        $commentRating -> user_id = $userID;
        $commentRating -> save();
        return redirect($this->getURI($bookId).'/'.$bookId);
    }

    public function deleteComment($bookId,$commentKey){
//        return $bookId.'delete comment'.$commentKey;
        $comment = Comment::findOrfail($commentKey);
        if(!$comment->isOwner())
            return redirect($this->getURI($bookId).'/'.$bookId);

        $userID = Auth::id();
        $book = Book::find($bookId);
        if( $comment->isOwner() || Auth::user()->isadmin() || $book->isOwner()) {
            $comment -> delete();
        }
        return redirect($this->getURI($bookId).'/'.$bookId);
    }

    public function getURI($id = null){
        if($id) {
            $book = Book::findOrfail($id);
            if ($book->isComic())
                return 'comics';
            else
                return 'books';
        }
        else {
            $uri = Route::getCurrentRoute()->getPath();
            if ($uri == 'comics')
                return 'comics';
            else
                return 'books';
        }
    }
}
