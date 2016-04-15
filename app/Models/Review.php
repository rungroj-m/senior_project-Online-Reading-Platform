<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $primaryKey = 'id';

	protected $table = 'books_reviews';

	use SoftDeletes;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'review','rating','book_id'];

	public function book() {
		return $this->belongsTo('App\Models\Book');
	}

	public function user(){
		return $this->belongsTo('App\Models\User');
	}

	public function isOwner(){
		if(Auth::check() && Auth::user()->isAdmin())
			return true;
		return $this->user_id == Auth::user()->getKey();
	}
}
