<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $primaryKey = 'commentKey';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['#comment', 'comment','commentRating'];

	public function book() {
		return $this->belongTo('Book')
	}

	public function content() {
		return $this->belongTo('Content')
	}
}
