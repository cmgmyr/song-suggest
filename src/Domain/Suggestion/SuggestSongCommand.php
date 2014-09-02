<?php
namespace Ss\Domain\Suggestion;

use Ss\Repositories\User\User;

class SuggestSongCommand
{
    public $artist;
    public $title;
    public $user;

    function __construct($artist, $title, User $user)
    {
        $this->artist = $artist;
        $this->title = $title;
        $this->user = $user;
    }
} 