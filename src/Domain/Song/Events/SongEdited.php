<?php
namespace Ss\Domain\Song\Events;

use Ss\Repositories\Song\Song;

class SongEdited
{
    public $song;

    function __construct(Song $song)
    {
        $this->song = $song;
    }
} 