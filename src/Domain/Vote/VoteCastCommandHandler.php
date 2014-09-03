<?php namespace Ss\Domain\Vote;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\Vote\Vote;
use Ss\Repositories\Vote\VoteInterface;

class VoteCastCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    protected $vote;

    function __construct(VoteInterface $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $vote = Vote::cast($command->song_id, $command->user_id, $command->vote);

        $this->vote->save($vote);

        $this->dispatchEventsFor($vote);

        return $vote;
    }

}