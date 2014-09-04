<?php
namespace Ss\Domain\Vote\Events;

use Ss\Repositories\Vote\Vote;

class VoteChanged
{
    public $vote;

    function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }
} 