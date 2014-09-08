<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class DeleteSongCommand
{
    public $song;
    public $editor;

    function __construct(Song $song, User $editor)
    {
        $this->song = $song;
        $this->editor = $editor;
    }
} 