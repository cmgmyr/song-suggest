<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;

class ResetVotesCommand
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
