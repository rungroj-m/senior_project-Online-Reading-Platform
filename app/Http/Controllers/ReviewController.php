<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\reviewRating;
use Request;
use App\Models\Book;
use Auth;
use DB;

class reviewController extends Controller
{
    /**
     * Init comment.
     */
    public function postReview($bookId){
        $book = Book::findOrFail($bookId);
        $ownerId = Auth::id();
        $input = Request::all();
        $review = Review::create($input);
        $review -> book_id = $book->getKey();
        $review -> user_id = $ownerId;
        $review -> save();
        return redirect('books/'.$bookId);
    }

    public function getComment($bookId){
        $book = Book::findOrFail($bookId);
        return Review::with(['user_id','review','rating'])->where('book_id'==$book->getKey());
    }

    public function alreadyRate($reviewId){
        $userID = Auth::id();
        $condition = ['user_id' => $userID , 'review_id' => $reviewId];
        $check = DB::table('reviewRatings')->where($condition)->first();
        if($check == null)
            return false;
        return true;

    }

    public function voteUpReview($bookId, $reviewId){
        if($this->alreadyRate($reviewId))
            return redirect('/books/'.$bookId);
        $userID = Auth::id();
        $review = Review::findOrfail($reviewId);
        $review -> rating ++;
        $review -> save();

        $reviewRating = new reviewRating();
        $reviewRating -> review_id = $reviewId;
        $reviewRating -> user_id = $userID;
        $reviewRating -> save();
        return redirect('/books/'.$bookId);
//        return 'voteup success';
    }

    public function voteDownReview($bookId, $reviewId){
        if($this->alreadyRate($reviewId))
            return redirect('/books/'.$bookId);
        $userID = Auth::id();
        $review = Review::findOrfail($reviewId);
        $review -> rating --;
        $review -> save();

        $reviewRating = new reviewRating();
        $reviewRating -> review_id = $reviewId;
        $reviewRating -> user_id = $userID;
        $reviewRating -> save();
        return redirect('/books/'.$bookId);
//        return 'voteup success';
    }

    public function deleteReview($reviewId){
        $review = Review::findOrfail($reviewId);
        $userID = Auth::id();
        if( $review->user_id == $userID ) {
            // delete
            $review -> delete();
            return 'can delete';
        }
        return 'wrong user can not delete';
    }
}
