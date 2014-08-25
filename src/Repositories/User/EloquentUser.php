<?php
namespace Ss\Repositories\User;

use Illuminate\Database\Eloquent\Model;

class EloquentUser implements UserInterface
{

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $user;

    function __construct(Model $user)
    {
        $this->user = $user;
    }

    /**
     * Fetches all users from data source
     *
     * @return object
     */
    public function all()
    {
        return $this->user->all();
    }

    /**
     * Fetches all users from data source and formats for
     * a Laravel form select
     *
     * @return array
     */
    public function listAll()
    {
        $users = $this->all();
        if (count($users) > 0) {
            $userList = array();
            foreach ($users as $user) {
                $userList[$user->id] = $user->first_name . ' ' . $user->last_name;
            }

            return $userList;
        }

        return array();
    }

    /**
     * Fetches and returns user data associated with an id
     *
     * @param $id
     * @return object
     * @throws UserNotFoundException
     */
    public function byId($id)
    {
        $user = $this->user->find($id);
        if (!$user) {
            throw new UserNotFoundException('No user found with ID: ' . $id);
        }

        return $user;
    }

    /**
     * Accept new user data that will be persisted in a data source
     *
     * @param array $data
     * @return int
     * @throws UserNotSavedException
     */
    public function save(array $data)
    {
        if (isset($data['id'])) {
            $user = $this->byId($data['id']);
        } else {
            $user = new $this->user;
        }

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];

        if (isset($data['is_active'])) {
            $user->is_active = $data['is_active'];
        }

        if (isset($data['is_admin'])) {
            $user->is_admin = $data['is_admin'];
        }

        if ($data['password']) {
            $user->password = $data['password'];
        }

        $user->save();

        if (!$user->id) {
            throw new UserNotSavedException('The user was not saved.');
        }

        return $user->id;
    }

    /**
     * Removes a user from data source
     *
     * @param $id
     * @return boolean
     */
    public function delete($id)
    {
        try {
            $user = $this->byId($id);
            $user->delete();

            return true;
        } catch (UserNotFoundException $e) {
            return false;
        }
    }
}