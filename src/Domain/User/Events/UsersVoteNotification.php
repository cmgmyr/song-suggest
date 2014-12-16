<?php
namespace Ss\Domain\User\Events;

use Ss\Repositories\Song\Song;

class UsersVoteNotification
{
    /**
     * @var Song
     */
    public $song;

    /**
     * @var
     */
    public $users;

    public function __construct(Song $song, $users)
    {
        $this->song = $song;
        $this->users = $users;
    }
}
