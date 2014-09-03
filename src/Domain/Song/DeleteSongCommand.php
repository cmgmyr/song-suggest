<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;

class DeleteSongCommand
{
    public $song;

    function __construct(Song $song)
    {
        $this->song = $song;
    }
} 