<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;

class ChangeCategoryCommand
{
    public $song;
    public $category;

    function __construct(Song $song, $category)
    {
        $this->song = $song;
        $this->category = $category;
    }
} 