<?php
namespace Ss\Domain\Song\Events;

use Ss\Repositories\Song\Song;

class SongSuggested
{
    public $song;

    function __construct(Song $song)
    {
        $this->song = $song;
    }
} 