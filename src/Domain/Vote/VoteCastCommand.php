<?php

namespace Ss\Domain\Vote;

class VoteCastCommand
{
    /**
     * @var
     */
    public $song_id;

    /**
     * @var
     */
    public $user_id;

    /**
     * @var
     */
    public $vote;

    public function __construct($song_id, $user_id, $vote)
    {
        $this->song_id = $song_id;
        $this->user_id = $user_id;
        $this->vote = $vote;
    }
}
