<?php

namespace Ss\Domain\Song\Events;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class SongEdited
{
    /**
     * @var Song
     */
    public $song;

    /**
     * @var User
     */
    public $editor;

    public function __construct(Song $song, User $editor)
    {
        $this->song = $song;
        $this->editor = $editor;
    }
}
