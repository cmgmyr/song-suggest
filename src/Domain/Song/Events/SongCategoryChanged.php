<?php
namespace Ss\Domain\Song\Events;

use Ss\Repositories\Song\Song;

class SongCategoryChanged
{

    /**
     * @var Song
     */
    public $song;

    function __construct(Song $song)
    {
        $this->song = $song;
    }
} 