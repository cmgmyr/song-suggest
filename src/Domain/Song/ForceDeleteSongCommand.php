<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class ForceDeleteSongCommand
{
    /**
     * @var Song
     */
    public $song;

    /**
     * @var User
     */
    public $editor;

    public function __construct(Song $song, User $editor)
    {
        $this->song = $song;
        $this->editor = $editor;
    }
}
