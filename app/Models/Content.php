<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $fillable = array('name','content','chapter','type','private');
	protected $primaryKey = 'id';

	public function book() {
		return $this->belongsTo('App\Models\Book');
	}

	public function comments() {
		return $this->hasMany('App\Models\Comment');
	}
}
