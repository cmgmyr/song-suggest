<?php

namespace Ss\Domain\Song\Events;

use Ss\Repositories\Song\Song;

class SongSuggested
{
    /**
     * @var Song
     */
    public $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }
}
