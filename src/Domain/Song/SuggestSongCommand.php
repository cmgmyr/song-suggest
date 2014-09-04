<?php
namespace Ss\Domain\Song;

use Ss\Repositories\User\User;

class SuggestSongCommand
{
    public $artist;
    public $title;
    public $youtube;
    public $user;

    function __construct($artist, $title, $youtube, User $user)
    {
        $this->artist = $artist;
        $this->title = $title;
        $this->youtube = $youtube;
        $this->user = $user;
    }
} 