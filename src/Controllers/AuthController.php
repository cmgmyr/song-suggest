<?php
namespace Ss\Controllers;

use Ss\Domain\User\UpdateUserCommand;
use Ss\Forms\UserForm;
use Ss\Repositories\User\UserInterface;
use Ss\Services\Notifications\Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class AuthController extends BaseController
{

    /**
     * @var \Ss\Repositories\User\UserInterface
     */
    protected $user;

    /**
     * @var \Ss\Forms\UserForm
     */
    protected $userForm;

    function __construct(UserInterface $user, UserForm $userForm)
    {
        $this->user = $user;
        $this->userForm = $userForm;

        $this->beforeFilter('guest', ['only' => ['login', 'attemptLogin']]);
    }

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
        $credentials = [
            'email'     => Input::get('email'),
            'password'  => Input::get('password'),
            'is_active' => 'y'
        ];

        if (Auth::attempt($credentials)) {
            return Redirect::home();
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

    public function account()
    {
        $user = $this->user->byId(Auth::id());

        $this->layout->content = View::make('auth.account', compact('user'));
    }

    public function accountUpdate()
    {
        $id = Auth::id();
        $user = $this->user->byId($id);

        $v = $this->userForm->updateUser($id);

        if (Input::has('password')) {
            $v->checkPassword();
        }

        $v->validate();

        $input = ['input' => Input::all(), 'user' => $user];

        $this->execute(UpdateUserCommand::class, $input);

        return $this->redirectRouteWithSuccess('home', 'Your account has been updated!');
    }
} 