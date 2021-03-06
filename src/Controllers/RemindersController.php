<?php

namespace Ss\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;

class RemindersController extends BaseController
{
    /**
     * Display the password reminder view.
     *
     * @return Response
     */
    public function getRemind()
    {
        $this->layout->content = View::make('password.remind');
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        switch ($response = Password::remind(Input::only('email'), function ($message) {
                $message->subject('Password Reset Instructions');
            })) {
            case Password::INVALID_USER:
                return $this->redirectBackWithError(Lang::get($response));

            case Password::REMINDER_SENT:
                return $this->redirectRouteWithSuccess('login', Lang::get($response));
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            App::abort(404);
        }

        $this->layout->content = View::make('password.reset')->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $credentials = Input::only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );

        $response = Password::reset(
            $credentials,
            function ($user, $password) {
                $user->password = $password;

                $user->save();
            }
        );

        switch ($response) {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return $this->redirectBackWithError(Lang::get($response));

            case Password::PASSWORD_RESET:
                return $this->redirectRouteWithSuccess('login', 'Your password has been reset. Please continue to log in.');
        }
    }
}
