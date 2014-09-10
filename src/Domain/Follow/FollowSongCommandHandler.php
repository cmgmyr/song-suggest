<?php namespace Ss\Domain\Follow;

use Laracasts\Commander\CommandHandler;
use Ss\Repositories\Follow\Follow;
use Ss\Repositories\Follow\FollowInterface;

class FollowSongCommandHandler implements CommandHandler
{

    protected $follow;

    function __construct(FollowInterface $follow)
    {
        $this->follow = $follow;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $follow = Follow::follow($command->song_id, $command->user_id);

        $this->follow->save($follow);

        return $follow;
    }

}