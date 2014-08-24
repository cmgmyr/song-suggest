<?php
namespace Ss\Controllers;

use Ss\Services\Notifications\Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class AuthController extends BaseController
{

    /**
     * Display a login form
     *
     * @return Response
     */
    public function login()
    {
        $this->layout->content = View::make('auth.login');
    }

    /**
     * Attempt to log the user in
     *
     * @return Response
     */
    public function attemptLogin()
    {
        $credentials = array(
            'email'     => Input::get('email'),
            'password'  => Input::get('password'),
            'is_active' => 'y'
        );

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return Redirect::to('/');
        } else {
            Flash::error('Sorry, your login credentials were not correct, or you are not allowed to log in');

            return Redirect::back()->withInput();
        }
    }

    /**
     * Log the user out
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();

        return Redirect::route('login');
    }
} 