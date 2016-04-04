<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Fenos\Notifynder\Notifable;


class User extends Model implements AuthenticatableContract,  AuthorizableContract, CanResetPasswordContract {

	use Authenticatable, Authorizable, CanResetPassword, Notifable;

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
	protected $fillable = ['username', 'firstName','lastName', 'email', 'password', 'userLevel' ,'image'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function books() {
		return $this->hasMany('App\Models\Book');
	}

	public function wallet() {
		return $this->hasOne('App\Models\Wallet');
	}

	public function subscriptions() {
		return $this->hasMany('App\Models\Subscription');
	}
}
