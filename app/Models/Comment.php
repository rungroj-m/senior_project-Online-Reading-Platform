<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'comment','comment_id','rating','book_id'];

	public function book() {
		return $this->belongsTo('App\Models\Book');
	}

	public function user(){
		return $this->belongsTo('App\Models\User');
	}

	public function parent()
	{
		return $this->belongsTo('App\Models\Comment','comment_id');
	}

	public function childs(){
		return $this->hasMany('App\Models\Comment');
	}

}
