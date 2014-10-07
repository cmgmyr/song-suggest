<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class EditSongCommand
{

    /**
     * @var Song
     */
    public $song;

    /**
     * @var User
     */
    public $editor;

    /**
     * @var
     */
    public $artist;

    /**
     * @var
     */
    public $title;

    /**
     * @var
     */
    public $youtube;

    /**
     * @var
     */
    public $mp3_file;

    function __construct(Song $song, User $editor, $artist, $title, $youtube, $mp3_file)
    {
        $this->song = $song;
        $this->editor = $editor;
        $this->artist = $artist;
        $this->title = $title;
        $this->youtube = $youtube;
        $this->mp3_file = $mp3_file;
    }
} 