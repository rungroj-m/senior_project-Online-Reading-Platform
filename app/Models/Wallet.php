<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';
	protected $fillable = array('bankAccount');

	public function user() {
		return $this->hasOne('App\Models\User');
	}
}
