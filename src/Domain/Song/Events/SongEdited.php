<?php
namespace Ss\Domain\Song\Events;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class SongEdited
{
    public $song;
    public $editor;

    function __construct(Song $song, User $editor)
    {
        $this->song = $song;
        $this->editor = $editor;
    }
} 