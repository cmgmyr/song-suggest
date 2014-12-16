<?php
namespace Ss\Repositories\Follow;

interface FollowInterface
{
    /**
     * Accept new follow data that will be persisted in data source
     *
     * @param Follow $follow
     * @return \Ss\Repositories\Follow\Follow
     * @throws FollowNotSavedException
     */
    public function save(Follow $follow);

    /**
     * Removes a follow from data source
     *
     * @param $songId
     * @param $userId
     * @return boolean
     */
    public function delete($songId, $userId);
}
