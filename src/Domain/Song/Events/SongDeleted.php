<?php
namespace Ss\Domain\Song\Events;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class SongDeleted
{

    /**
     * @var Song
     */
    public $song;

    /**
     * @var User
     */
    public $editor;

    function __construct(Song $song, User $editor)
    {
        $this->song = $song;
        $this->editor = $editor;
    }
} 