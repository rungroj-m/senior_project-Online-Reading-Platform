<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $fillable = array('user_id', 'book_id', 'active');
	protected $primaryKey = 'id';

	public function user() {
		return $this->belongsTo('App\Models\User');
	}

	public function book() {
		return $this->belongsTo('App\Models\Book');
	}
}
