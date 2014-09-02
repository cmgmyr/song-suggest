<?php
namespace Ss\Controllers;

use Ss\Repositories\User\UserInterface;
use Ss\Forms\UserForm;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class UsersController extends BaseController
{

    /**
     * @var \Ss\Repositories\User\UserInterface
     */
    protected $user;

    /**
     * @var \Ss\Forms\UserForm
     */
    protected $validation;

    function __construct(UserInterface $user, UserForm $validation)
    {
        $this->user = $user;
        $this->validation = $validation;
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
        $this->validation->createUser()->validate();
        $this->user->save(Input::all());

        return $this->redirectRouteWithSuccess('users', 'The user has been saved.');
    }

    public function edit($id)
    {
        $user = $this->user->byId($id);

        $this->layout->content = View::make('users.edit', compact('user'));
    }

    public function update($id)
    {
        $v = $this->validation->updateUser($id);

        if (Input::has('password')) {
            $v->checkPassword();
        }

        $v->validate();

        $this->user->save(array_merge(Input::all(), array('id' => $id)));

        return $this->redirectRouteWithSuccess('users', 'The user has been saved.');
    }

    public function destroy($id)
    {
        if ($this->user->delete($id)) {
            return $this->redirectRouteWithSuccess('users', 'The user has been deleted.');
        }

        return $this->redirectRouteWithError('users', 'There was an error when trying to delete the user.');
    }
} 