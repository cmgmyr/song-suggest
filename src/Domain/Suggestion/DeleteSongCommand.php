<?php
namespace Ss\Domain\Suggestion;

use Ss\Repositories\Song\Song;

class DeleteSongCommand
{
    public $song;

    function __construct(Song $song)
    {
        $this->song = $song;
    }
} 