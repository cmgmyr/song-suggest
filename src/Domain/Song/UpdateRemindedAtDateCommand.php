<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;

class UpdateRemindedAtDateCommand
{
    /**
     * @var Song
     */
    public $song;

    /**
     * @var
     */
    public $days;

    public function __construct(Song $song, $days)
    {
        $this->song = $song;
        $this->days = $days;
    }
}
