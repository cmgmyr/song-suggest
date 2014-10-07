<?php
namespace Ss\Domain\Song;

use Ss\Repositories\Song\Song;

class SongCategoryChangedCommand
{

    /**
     * @var Song
     */
    public $song;

    /**
     * @var
     */
    public $category_id;

    function __construct(Song $song, $category_id)
    {
        $this->song = $song;
        $this->category_id = $category_id;
    }
}