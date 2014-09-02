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
     * @param User $user
     * @throws UserNotSavedException
     * @return int
     */
    public function save(User $user)
    {
        $user->save();

        if (!$user->id) {
            throw new UserNotSavedException('The user was not saved.');
        }

        return $user->id;
    }

    /**
     * Removes a user from data source
     *
     * @param User $user
     * @return boolean
     */
    public function delete(User $user)
    {
        $user->delete();

        return true;
    }
}