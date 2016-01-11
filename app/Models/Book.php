<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $fillable = array('name','description','userRatingCount','userRating','criticRating','TAG','category');
	protected $primaryKey = 'bookKey';

	public function user() {
		return $this->belongTo('User');
	}

	public function content() {
		return $this->belongsToMany('App\Models\Content','books_contents', 'bookKey', 'contentKey');
	}

	public function comment() {
		return $this->hasMany('Comment');
	}
}
