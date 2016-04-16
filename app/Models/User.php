<?php namespace App\Models;

use Fenos\Notifynder\Facades\Notifynder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Fenos\Notifynder\Notifable;
use Illuminate\Support\Facades\Auth;


class User extends Model implements AuthenticatableContract,  AuthorizableContract, CanResetPasswordContract {

	use Authenticatable, Authorizable, CanResetPassword, Notifable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'firstName','lastName', 'email', 'password', 'userLevel' ,'image','imageLevel'];

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

	public function isCritic(){
		if($this->isAdmin())
			return true;
		return Auth::check() && $this->userLevel == 1;
	}

	public function isAdmin(){
		return Auth::check() && $this->userLevel == 2;
	}

	public function isComicCreator(){
		if($this->isAdmin())
			return true;
		return Auth::check() && $this->imageLevel == 1;
	}

	public function isRequestComicCreator(){
		return Auth::check() && $this->imageLevel == 2;
	}

	public function donations() {
		return $this->hasMany('App\Models\Donation');
	}

	public function pleadings() {
		return $this->hasMany('App\Models\Pleading');
	}

	public function readNoti($noti_id){
		Notifynder::readOne($noti_id);
	}

}
