<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Fenos\Notifynder\Notifable;
use Auth;
use DB;

class Book extends Model {

	use Notifable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $fillable = array('name','description','userRatingCount','userRating','criticRating','category','criticRatingCount','user_id');
	protected $primaryKey = 'id';

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function contents() {
		return $this->belongsToMany('App\Models\Content','books_contents', 'book_id', 'content_id')->orderBy('chapter');
	}

	public function comments() {
		return $this->hasMany('App\Models\Comment')->orderBy('rating','DESC');
	}

	public function tags() {
		return $this->belongsToMany('App\Models\Tag', 'book_tags', 'book_id', 'tag_id');
	}

	public function subscribers() {
		return $this->hasMany('App\Models\Subscription');
	}

	public function reviews() {
		return $this->hasMany('App\Models\Review')->orderBy('rating','DESC');
	}

	public function isOwner(){
		return $this->user_id == Auth::user()->getKey();
	}
	public function isComic(){
		return $this->category == 'Comic';
	}
	public function donations() {
		return $this->hasMany('App\Models\Donation');
	}

	public function alreadyVote(){
		$userID = Auth::id();
		$condition = ['user_id' => $userID , 'book_id' => $this->id];
		$check = DB::table('ratings')->where($condition)->first();
		if($check == null)
			return false;
		return true;
	}

	public function getUserRatingAverage(){
		if($this->userRatingCount > 0)
			return $this->userRating / $this->userRatingCount;
		else
			return 0;
	}

	public function getCriticRatingAverage(){
		if($this->criticRatingCount > 0)
			return $this->criticRating / $this->criticRatingCount;
		else
			return 0;
	}
}
