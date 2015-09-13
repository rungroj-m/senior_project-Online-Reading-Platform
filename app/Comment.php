<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comment';


	protected $primaryKey = 'commentKey';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['contentKey','#comment', 'userKey', 'comment','commentRating'];
}
