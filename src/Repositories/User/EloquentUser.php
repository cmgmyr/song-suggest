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
     * Counts all active users
     *
     * @return integer
     */
    public function countAll()
    {
        return $this->user->where('is_active', 'y')->count();
    }

    /**
     * Fetches all deleted users from data source
     *
     * @return object
     */
    public function deleted()
    {
        return $this->user->onlyTrashed()->get();
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
            $userList = [];
            foreach ($users as $user) {
                $userList[$user->id] = $user->first_name . ' ' . $user->last_name;
            }

            return $userList;
        }

        return [];
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

        return $user;
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

    /**
     * Find all of the users that can be emailed
     *
     * @param null $except user id exception
     * @return object
     */
    public function getAllEmailableUsers($except = null)
    {
        $query = $this->user->where('notify', 'y');

        if ($except !== null) {
            $query->where('id', '!=', $except);
        }

        return $query->get();
    }

    /**
     * Fetches and returns user data associated with a deleted id
     *
     * @param $id
     * @return object
     * @throws UserNotFoundException
     */
    public function deletedWithId($id)
    {
        $user = $this->user->withTrashed()->where('id', $id)->first();
        if (!$user) {
            throw new UserNotFoundException('No deleted user found with ID: ' . $id);
        }

        return $user;
    }

    /**
     * Restores a user from being soft deleted
     *
     * @param User $user
     * @internal param $id
     * @return boolean
     */
    public function restore(User $user)
    {
        $user->restore();

        return true;
    }
}