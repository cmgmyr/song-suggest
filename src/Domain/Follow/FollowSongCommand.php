<?php namespace Ss\Domain\Follow;

class FollowSongCommand
{

    /**
     * @var
     */
    public $song_id;

    /**
     * @var
     */
    public $user_id;

    function __construct($song_id, $user_id)
    {
        $this->song_id = $song_id;
        $this->user_id = $user_id;
    }

}