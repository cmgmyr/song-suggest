<?php namespace Ss\Domain\Follow;

class FollowSongCommand
{

    public $song_id;
    public $user_id;

    function __construct($song_id, $user_id)
    {
        $this->song_id = $song_id;
        $this->user_id = $user_id;
    }

}