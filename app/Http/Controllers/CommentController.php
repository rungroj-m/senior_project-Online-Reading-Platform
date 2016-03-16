<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\CommentRating;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return $comment;
    }

    public function getComment($bookId){

        $book = Book::findOrFail($bookId);

        return Comment::with(['user_id','comment','rating'])->where('book_id'$book->getKey());


//        $book_comments = DB::table('comments')
//            ->where('bookKey',$book->getKey())
//            ->orderBy('created_at', 'desc')->get();
//        return $book_comments;

    }

    /**
     * replied comment
     */
    public function repliedComment($commentKey,$bookId){
        $book = Book::findOrFail($bookId);

        $ownerId = Auth::id();
        $input = Request::all();
        $comment = Comment::create($input);
        $comment -> book_id = $book->getKey();
        $comment -> user_id = $ownerId;
        $comment -> comment_id = $commentKey;
        $comment -> save();
        return $comment;

    }

//    public function nodeComment($book_comments,$parentKey){
//        foreach($book_comments as $comment){
//            if($comment -> ownerKey == $parentKey){
//                return nodeComment($book_comments,$comment->getKey());
//            }
//
//        }
//    }

    public function alreadyRate($commentKey){
        $userID = Auth::id();
        $condition = ['user_id' => $userID , 'id' => $commentKey];
        $check = DB::table('commentRatings')->where($condition)->first();
        if($check == null)
            return false;
        return true;

    }

    public function voteUpComment($commentKey){
        if($this->alreadyRate($commentKey))
            return 'already vote';
        $userID = Auth::id();
        $comment = Comment::findOrfail($commentKey);
        $comment -> rating ++;
        $comment -> save();

        $commentRating = new CommentRating();
        $commentRating -> id = $commentKey;
        $commentRating -> user_id = $userID;
        $commentRating -> save();
        return 'voteup success';
    }

    public function voteDownComment($commentKey){
        if($this->alreadyRate($commentKey))
            return 'already vote';
        $userID = Auth::id();
        $comment = Comment::findOrfail($commentKey);
        $comment -> rating --;
        $comment -> save();

        $commentRating = new CommentRating();
        $commentRating -> id = $commentKey;
        $commentRating -> user_id = $userID;
        $commentRating -> save();
        return 'votedown success';
    }

    public function deleteComment($commentKey){
        $comment = Comment::findOrfail($commentKey);
        $userID = Auth::id();
        if( $comment->user_id == $userID ) {
            // delete
            $comment -> delete();
            return 'can delete';
        }
        return 'wrong user can not delete';
    }
}
