<?php

namespace Ss\Domain\Vote\Events;

use Ss\Repositories\Vote\Vote;

class VoteCast
{
    /**
     * @var Vote
     */
    public $vote;

    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }
}
