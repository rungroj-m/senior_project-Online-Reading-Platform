<?php namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Auth;
use Socialize;
//use Laravel\Socialite as Socialite;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
        private $socialite;
		protected $loginPath = '/login'; // path to the login URL
		protected $registerPath = '/register';
	 	protected $redirectPath = '/index'; // path to the route where you want users to be redirected once logged in
	 	protected $redirectTo = '/'; // path you're sent to once you've reset your password

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        // $this->middleware('guest', ['except' => 'logout']);
//    }

    public function __construct(Socialite $socialite){
        $this->socialite = $socialite;
    }


    public function getSocialAuth($provider=null)
    {
        if(!config("services.$provider")) abort('404'); //just to handle providers that doesn't exist

        return $this->socialite->with($provider)->redirect();
    }


    public function getSocialAuthCallback($provider=null)
    {
        if($user = $this->socialite->with($provider)->user()){

            $authUser = $this->findOrCreateUser($user);

            Auth::login($authUser,true);

            return redirect('books');

        }else{
            return 'something went wrong';
        }
    }

    function findOrCreateUser($facebookUser){

//        dd($facebookUser);

        if($authUser =  User::where('facebook_id', $facebookUser->getId())->first()){
            return $authUser;
        }

        if($authUser =  User::where('email', $facebookUser->getEmail())->first()){
            $authUser -> facebook_id = $facebookUser -> getId();
            $authUser -> facebook_token = $facebookUser -> token;
            $authUser -> save();
            return $authUser;
        }

        else{
            $user = User::create([
                'username' => $facebookUser->getName(),
                'email' => $facebookUser->getEmail(),
            ]);
            $user -> facebook_id = $facebookUser -> getId();
            $user -> facebook_token = $facebookUser -> token;
						$user -> email_noti = 0;
						$user -> facebook_noti = 0;
            $user->save();
            return $user;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'firstName' => 'firstName',
            'lastName' => 'lastName',
        ]);
    }

}
