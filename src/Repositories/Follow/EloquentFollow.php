<?php

namespace Ss\Repositories\Follow;

use Illuminate\Database\Eloquent\Model;

class EloquentFollow implements FollowInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $follow;

    public function __construct(Model $follow)
    {
        $this->follow = $follow;
    }

    /**
     * Accept new follow data that will be persisted in data source.
     *
     * @param Follow $follow
     * @return \Ss\Repositories\Follow\Follow
     * @throws FollowNotSavedException
     */
    public function save(Follow $follow)
    {
        $follow->save();

        if (!$follow->id) {
            throw new FollowNotSavedException('The follow was not saved.');
        }

        return $follow;
    }

    /**
     * Removes a follow from data source.
     *
     * @param $songId
     * @param $userId
     * @return boolean
     */
    public function delete($songId, $userId)
    {
        $this->follow->where('song_id', $songId)->where('user_id', $userId)->delete();

        return true;
    }
}
