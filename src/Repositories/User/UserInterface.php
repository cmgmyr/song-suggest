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
     * Accept new user data that will be persisted in data source
     *
     * @param array $data
     * @return int
     * @throws UserNotSavedException
     */
    public function save(array $data);

    /**
     * Removes a user from data source
     *
     * @param $id
     * @return boolean
     */
    public function delete($id);
} 