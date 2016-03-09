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
	protected $fillable = ['ownerKey', 'comment','parentKey','rating','bookKey'];

	public function book() {
		return $this->belongTo('Book');
	}

	public function parent()
	{
		return $this->belongsTo('App\Models\Comment');
	}

	public function child(){
		return $this->hasMany('App\Models\Comment');
	}

}
