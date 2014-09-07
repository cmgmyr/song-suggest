<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class EditSongCommand
{
    public $song;
    public $editor;
    public $artist;
    public $title;
    public $youtube;

    function __construct(Song $song, User $editor, $artist, $title, $youtube)
    {
        $this->song = $song;
        $this->editor = $editor;
        $this->artist = $artist;
        $this->title = $title;
        $this->youtube = $youtube;
    }
} 