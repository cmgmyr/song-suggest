<?php
namespace Ss\Domain\Suggestion\Events;

use Ss\Repositories\Song\Song;

class SongDeleted
{
    public $song;

    function __construct(Song $song)
    {
        $this->song = $song;
    }
} 