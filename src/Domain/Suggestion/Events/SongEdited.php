<?php
namespace Ss\Domain\Suggestion\Events;

use Ss\Repositories\Song\Song;

class SongEdited
{
    public $song;

    function __construct(Song $song)
    {
        $this->song = $song;
    }
} 