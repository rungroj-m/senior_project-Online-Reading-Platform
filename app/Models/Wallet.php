<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'wallet';
	protected $fillable = array('userKey','bankAccount');
}
