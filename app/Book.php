<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'book';
	protected $fillable = 'contentKey';
	protected $primaryKey = 'bookKey';
}
