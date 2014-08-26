<?php
namespace Ss\Domain\Suggestion;

use Ss\Repositories\Song\Song;

class EditSongCommand
{
    public $song;
    public $artist;
    public $title;

    function __construct(Song $song, $artist, $title)
    {
        $this->song = $song;
        $this->artist = $artist;
        $this->title = $title;
    }
} 