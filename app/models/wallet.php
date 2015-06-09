<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class wallet extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'wallet';
	protected $fillable = array('userKey','bankAccount');
}
