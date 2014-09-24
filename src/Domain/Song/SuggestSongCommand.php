<?php
namespace Ss\Domain\Song;

use Ss\Repositories\User\User;

class SuggestSongCommand
{
    public $artist;
    public $title;
    public $youtube;
    public $mp3_file;
    public $user;

    function __construct($artist, $title, $youtube, $mp3_file, User $user)
    {
        $this->artist = $artist;
        $this->title = $title;
        $this->youtube = $youtube;
        $this->mp3_file = $mp3_file;
        $this->user = $user;
    }
} 