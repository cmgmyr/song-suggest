<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;

class UpdateRemindedAtDate
{

    /**
     * @var Song
     */
    public $song;

    /**
     * @var
     */
    public $days;

    function __construct(Song $song, $days)
    {
        $this->song = $song;
        $this->days = $days;
    }
} 