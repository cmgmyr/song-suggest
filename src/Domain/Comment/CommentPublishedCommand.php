<?php namespace Ss\Domain\Comment;

class CommentPublishedCommand
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
    public $comment;

    public function __construct($song_id, $user_id, $comment)
    {
        $this->song_id = $song_id;
        $this->user_id = $user_id;
        $this->comment = $comment;
    }
}
