<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

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
		return $this->hasMany('App\Models\Content','books_contents');
	}

	public function comments() {
		return $this->hasMany('App\Models\Comment');
	}

	public function tags() {
		return $this->hasMany('App\Models\Tag');
	}
}
