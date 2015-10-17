<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $fillable = array('name','content','chapter');
	protected $primaryKey = 'contentKey';

	public function book() {
		return $this->belongTo('Book');
	}

	public function comment() {
		return $this->hasMany('Comment')
	}
}
