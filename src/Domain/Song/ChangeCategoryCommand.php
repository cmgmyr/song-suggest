<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;

class ChangeCategoryCommand
{

    /**
     * @var Song
     */
    public $song;

    /**
     * @var
     */
    public $category;

    function __construct(Song $song, $category)
    {
        $this->song = $song;
        $this->category = $category;
    }
} 