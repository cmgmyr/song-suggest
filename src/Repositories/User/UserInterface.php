<?php
namespace Ss\Repositories\User;

interface UserInterface
{

    /**
     * Fetches all users from data source
     *
     * @return object
     */
    public function all();

    /**
     * Fetches all users from data source and formats for
     * a Laravel form select
     *
     * @return array
     */
    public function listAll();

    /**
     * Fetches and returns user data associated with an id
     *
     * @param $id
     * @return object
     * @throws UserNotFoundException
     */
    public function byId($id);

    /**
     * Accept new user data that will be persisted in a data source
     *
     * @param User $user
     * @throws UserNotSavedException
     * @return int
     */
    public function save(User $user);

    /**
     * Removes a user from data source
     *
     * @param User $user
     * @return boolean
     */
    public function delete(User $user);

    /**
     * Find all of the users that can be emailed
     *
     * @param null $except user id exception
     * @return object
     */
    public function getAllEmailableUsers($except = null);
} 