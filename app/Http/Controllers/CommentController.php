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
        $comment -> bookKey = $book->getKey();
        $comment -> ownerKey = $ownerId;
        $comment -> save();
        return $comment;
    }

    /**
     * replied comment
     */
    public function repliedComment($commentKey,$bookId){
        $book = Book::findOrFail($bookId);

        $ownerId = Auth::id();
        $input = Request::all();
        $comment = Comment::create($input);
        $comment -> bookKey = $book->getKey();
        $comment -> ownerKey = $ownerId;
        $comment -> parentKey = $commentKey;
        $comment -> save();
        return $comment;

    }

    public function alreadyRate($commentKey){
        $userID = Auth::id();
        $condition = ['userKey' => $userID , 'commentKey' => $commentKey];
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
        $commentRating -> commentKey = $commentKey;
        $commentRating -> userKey = $userID;
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
        $commentRating -> commentKey = $commentKey;
        $commentRating -> userKey = $userID;
        $commentRating -> save();
        return 'votedown success';
    }

    public function deleteComment($commentKey){
        $comment = Comment::findOrfail($commentKey);
        $userID = Auth::id();
        if( $comment->ownerKey == $userID ) {
            // delete
            $comment -> delete();
            return 'can delete';
        }
        return 'wrong user can not delete';
    }
}
