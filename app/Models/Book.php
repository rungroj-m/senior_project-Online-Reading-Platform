<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $fillable = array('name','description','userRatingCount','userRating','criticRating','TAG','category','criticRatingCount','ownerKey');
	protected $primaryKey = 'bookKey';

	public function user() {
		return $this->belongsTo('App\Models\User','ownerKey','userKey');
	}

	public function contents() {
		return $this->belongsToMany('App\Models\Content','books_contents', 'bookKey', 'contentKey');
	}

	public function comments() {
		return $this->hasMany('App\Models\Comment','commentKey','commentKey');
	}
}
