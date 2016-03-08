<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 3/8/2016 AD
 * Time: 1:19 PM
 */

namespace App\Providers;

use Auth;
use App\Models\User;
use View;
use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('app', function($view){

            $id = Auth::id();
            $user = User::find($id);
            $view->with('user',$user);
        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }



}