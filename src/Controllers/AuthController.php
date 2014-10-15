<?php
namespace Ss\Controllers;

use Illuminate\Support\Facades\Config;
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

        $this->beforeFilter('csrf', ['on' => ['post']]);
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

        $remember = Input::get('remember') == 'y' ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            return Redirect::intended('');
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

    /**
     * Shows the account form to the user
     */
    public function account()
    {
        $user = $this->user->byId(Auth::id());

        $this->layout->content = View::make('auth.account', compact('user'));
    }

    /**
     * Updates the user's account information
     *
     * @return Response
     * @throws \Ss\Services\Validation\FormValidationException
     */
    public function accountUpdate()
    {
        $id = Auth::id();
        $user = $this->user->byId($id);

        $v = $this->userForm->updateUser($id);

        if (Input::has('password')) {
            $v->checkPassword();
        }

        $v->validate();

        $input = $this->handleUpload($id, Input::all());
        $input = ['input' => $input, 'user' => $user];

        $this->execute(UpdateUserCommand::class, $input);

        return $this->redirectRouteWithSuccess('home', 'Your account has been updated!');
    }

    /**
     * Handles jpg uploads from the account form
     *
     * @param $id
     * @param $input
     * @return array
     */
    protected function handleUpload($id, $input)
    {
        $input = array_merge($input, ['image' => null]);

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            if($file->getClientOriginalExtension() == 'jpg') {
                $fileName = str_random(40);
                $file->move(Config::get('uploads.location'), $fileName . '.jpg');

                $input = array_merge($input, ['image' => $fileName]);
            }
        }

        return $input;
    }
} 