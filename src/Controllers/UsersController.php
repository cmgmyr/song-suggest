<?php

namespace Ss\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Ss\Domain\User\CreateUserCommand;
use Ss\Domain\User\DeleteUserCommand;
use Ss\Domain\User\RestoreUserCommand;
use Ss\Domain\User\UpdateUserCommand;
use Ss\Forms\UserForm;
use Ss\Repositories\User\UserInterface;
use Ss\Repositories\User\UserNotFoundException;

class UsersController extends BaseController
{
    /**
     * @var \Ss\Repositories\User\UserInterface
     */
    protected $user;

    /**
     * @var \Ss\Forms\UserForm
     */
    protected $userForm;

    public function __construct(UserInterface $user, UserForm $userForm)
    {
        $this->user = $user;
        $this->userForm = $userForm;
    }

    /**
     * Shows all of the non-deleted users.
     */
    public function index()
    {
        $users = $this->user->all();

        $this->layout->content = View::make('users.index', compact('users'));
    }

    /**
     * Shows all of the deleted users.
     */
    public function deleted()
    {
        $users = $this->user->deleted();

        $this->layout->content = View::make('users.deleted', compact('users'));
    }

    /**
     * Shows the form to create a new user.
     */
    public function create()
    {
        $user = new \stdClass();

        // set up defaults
        $user->is_active = 'y';
        $user->is_admin = 'n';
        $user->notify = 'y';

        $this->layout->content = View::make('users.create', compact('user'));
    }

    /**
     * Saves the user from the create form.
     *
     * @return mixed
     * @throws \Ss\Services\Validation\FormValidationException
     */
    public function store()
    {
        $this->userForm->createUser()->validate();

        $this->execute(CreateUserCommand::class);

        return $this->redirectRouteWithSuccess('users', 'The user has been saved.');
    }

    /**
     * Shows the form to edit a user.
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        try {
            $user = $this->user->byId($id);

            $this->layout->content = View::make('users.edit', compact('user'));
        } catch (UserNotFoundException $e) {
            return $this->redirectRouteWithError('users', $e->getMessage());
        }
    }

    /**
     * Saves the user from the edit form.
     *
     * @param $id
     * @return mixed
     * @throws \Ss\Services\Validation\FormValidationException
     */
    public function update($id)
    {
        $user = $this->user->byId($id);

        $v = $this->userForm->updateUser($id);

        if (Input::has('password')) {
            $v->checkPassword();
        }

        $v->validate();

        $input = ['input' => Input::all(), 'user' => $user];

        $this->execute(UpdateUserCommand::class, $input);

        return $this->redirectRouteWithSuccess('users', 'The user has been saved.');
    }

    /**
     * Deletes a user.
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $user = $this->user->byId($id);

            $this->execute(DeleteUserCommand::class, ['user' => $user]);

            return $this->redirectRouteWithSuccess('users', 'The user has been deleted.');
        } catch (UserNotFoundException $e) {
            return $this->redirectRouteWithError('users', $e->getMessage());
        }
    }

    /**
     * Restores a user.
     *
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        try {
            $user = $this->user->deletedWithId($id);

            if (Auth::user()->is_admin != 'y') {
                $message = 'Sorry, this user cannot currently be restored or you don\'t have the correct access to do so.';

                return $this->redirectRouteWithError('users.show', $message, ['id' => $id]);
            }

            $this->execute(RestoreUserCommand::class, ['user' => $user]);

            return $this->redirectBackWithSuccess('The user has been restored.');
        } catch (UserNotFoundException $e) {
            return $this->redirectBackWithError($e->getMessage());
        }
    }
}
