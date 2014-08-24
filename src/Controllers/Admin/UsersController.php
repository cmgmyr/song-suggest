<?php
namespace Cmgmyr\LaravelStarter\Controllers\Admin;

use Cmgmyr\LaravelStarter\Repositories\User\UserInterface;
use Cmgmyr\LaravelStarter\Services\Validation\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class UsersController extends AdminController
{

    /**
     * @var \Cmgmyr\LaravelStarter\Repositories\User\UserInterface
     */
    protected $user;

    /**
     * @var \Cmgmyr\LaravelStarter\Services\Validation\User
     */
    protected $validation;

    function __construct(UserInterface $user, User $validation)
    {
        $this->user = $user;
        $this->validation = $validation;
    }

    public function index()
    {
        $users = $this->user->all();
        $admin_id = Auth::user()->id;

        $this->layout->activeLink = 'users';
        $this->layout->content = View::make('admin.users.index', compact('users', 'admin_id'));
    }

    public function create()
    {
        $user = new \stdClass();

        // set up defaults
        $user->is_active = 'y';
        $user->is_admin = 'n';

        $this->layout->activeLink = 'users.create';
        $this->layout->content = View::make('admin.users.create', compact('user'));
    }

    public function store()
    {
        $this->validation->createUser()->validate();
        $this->user->save(Input::all());

        return $this->redirectRouteWithSuccess('admin.users', 'The user has been saved.');
    }

    public function edit($id)
    {
        $user = $this->user->byId($id);

        $this->layout->content = View::make('admin.users.edit', compact('user'));
    }

    public function update($id)
    {
        $v = $this->validation->updateUser($id);

        if (Input::has('password')) {
            $v->checkPassword();
        }

        $v->validate();

        $this->user->save(array_merge(Input::all(), array('id' => $id)));

        return $this->redirectRouteWithSuccess('admin.users', 'The user has been saved.');
    }

    public function destroy($id)
    {
        if ($this->user->delete($id)) {
            return $this->redirectRouteWithSuccess('admin.users', 'The user has been deleted.');
        }

        return $this->redirectRouteWithError('admin.users', 'There was an error when trying to delete the user.');
    }
} 