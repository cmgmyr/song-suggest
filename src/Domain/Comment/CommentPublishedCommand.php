<?php namespace Ss\Domain\Comment;

class CommentPublishedCommand
{

    public $song_id;
    public $user_id;
    public $comment;

    function __construct($song_id, $user_id, $comment)
    {
        $this->song_id = $song_id;
        $this->user_id = $user_id;
        $this->comment = $comment;
    }

}