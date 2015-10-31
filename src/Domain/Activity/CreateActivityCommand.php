<?php

namespace Ss\Domain\Activity;

class CreateActivityCommand
{
    /**
     * @var
     */
    public $song_id;

    /**
     * @var
     */
    public $user_id;

    /**
     * @var
     */
    public $message;

    /**
     * @var
     */
    public $color_class;

    public function __construct($message, $song_id, $user_id, $color_class)
    {
        $this->message = $message;
        $this->song_id = $song_id;
        $this->user_id = $user_id;
        $this->color_class = $color_class;
    }
}
