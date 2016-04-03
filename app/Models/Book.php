<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Fenos\Notifynder\Notifable;

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
		return $this->belongsToMany('App\Models\Content','books_contents', 'book_id', 'content_id');
	}

	public function comments() {
		return $this->hasMany('App\Models\Comment');
	}

	public function tags() {
		return $this->hasMany('App\Models\Tag');
	}

	public function subscribers() {
		return $this->hasMany('App\Models\Subscription');
	}
}
