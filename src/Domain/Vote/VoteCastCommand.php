<?php namespace Ss\Domain\Vote;

class VoteCastCommand
{

    public $song_id;
    public $user_id;
    public $vote;

    function __construct($song_id, $user_id, $vote)
    {
        $this->song_id = $song_id;
        $this->user_id = $user_id;
        $this->vote = $vote;
    }

}