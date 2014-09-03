<?php
namespace Ss\Controllers;

use Ss\Core\CommandBus;
use Ss\Domain\User\CreateUserCommand;
use Ss\Domain\User\DeleteUserCommand;
use Ss\Domain\User\UpdateUserCommand;
use Ss\Repositories\User\UserInterface;
use Ss\Forms\UserForm;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Ss\Repositories\User\UserNotFoundException;

class UsersController extends BaseController
{

    use CommandBus;

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
    }

    public function index()
    {
        $users = $this->user->all();

        $this->layout->content = View::make('users.index', compact('users'));
    }

    public function create()
    {
        $user = new \stdClass();

        // set up defaults
        $user->is_active = 'y';
        $user->is_admin = 'n';

        $this->layout->content = View::make('users.create', compact('user'));
    }

    public function store()
    {
        $this->userForm->createUser()->validate();

        extract(Input::all());
        $command = new CreateUserCommand($first_name, $last_name, $email, $password, $is_admin, $is_active);
        $this->execute($command);

        return $this->redirectRouteWithSuccess('users', 'The user has been saved.');
    }

    public function edit($id)
    {
        try {
            $user = $this->user->byId($id);

            $this->layout->content = View::make('users.edit', compact('user'));
        } catch (UserNotFoundException $e) {
            return $this->redirectRouteWithError('users', $e->getMessage());
        }
    }

    public function update($id)
    {
        $user = $this->user->byId($id);

        $v = $this->userForm->updateUser($id);

        if (Input::has('password')) {
            $v->checkPassword();
        }

        $v->validate();

        $input = Input::all();
        $command = new UpdateUserCommand($user, $input);
        $this->execute($command);

        return $this->redirectRouteWithSuccess('users', 'The user has been saved.');
    }

    public function destroy($id)
    {
        try {
            $user = $this->user->byId($id);

            $command = new DeleteUserCommand($user);
            $this->execute($command);

            return $this->redirectRouteWithSuccess('users', 'The user has been deleted.');
        } catch (UserNotFoundException $e) {
            return $this->redirectRouteWithError('home', $e->getMessage());
        }
    }
} 