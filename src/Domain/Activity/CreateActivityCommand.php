<?php
namespace Ss\Domain\Activity;

class CreateActivityCommand
{

    public $song_id;
    public $user_id;
    public $message;
    public $color_class;

    function __construct($message, $song_id, $user_id, $color_class)
    {
        $this->message = $message;
        $this->song_id = $song_id;
        $this->user_id = $user_id;
        $this->color_class = $color_class;
    }
} 