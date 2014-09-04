<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;

class EditSongCommand
{
    public $song;
    public $artist;
    public $title;
    public $youtube;

    function __construct(Song $song, $artist, $title, $youtube)
    {
        $this->song = $song;
        $this->artist = $artist;
        $this->title = $title;
        $this->youtube = $youtube;
    }
} 