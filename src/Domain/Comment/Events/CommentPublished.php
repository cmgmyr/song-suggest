<?php
namespace Ss\Domain\Comment\Events;

use Ss\Repositories\Comment\Comment;

class CommentPublished
{

    /**
     * @var Comment
     */
    public $comment;

    function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
} 