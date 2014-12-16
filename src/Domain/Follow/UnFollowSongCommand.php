<?php namespace Ss\Domain\Follow;

class UnFollowSongCommand
{
    /**
     * @var
     */
    public $song_id;

    /**
     * @var
     */
    public $user_id;

    public function __construct($song_id, $user_id)
    {
        $this->song_id = $song_id;
        $this->user_id = $user_id;
    }
}
