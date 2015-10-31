<?php

namespace Ss\Domain\Song\Events;

use Ss\Repositories\Song\Song;

class SongVotesReset
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
