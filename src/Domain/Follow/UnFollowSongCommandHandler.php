<?php

namespace Ss\Domain\Follow;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\Follow\FollowInterface;

class UnFollowSongCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var FollowInterface
     */
    protected $follow;

    public function __construct(FollowInterface $follow)
    {
        $this->follow = $follow;
    }

    /**
     * Handle the command.
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $this->follow->delete($command->song_id, $command->user_id);
    }
}
