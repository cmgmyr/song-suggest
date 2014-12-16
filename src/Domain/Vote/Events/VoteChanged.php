<?php
namespace Ss\Domain\Vote\Events;

use Ss\Repositories\Vote\Vote;

class VoteChanged
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
