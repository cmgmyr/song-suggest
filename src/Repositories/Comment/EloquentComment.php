<?php
namespace Ss\Repositories\Comment;

use Illuminate\Database\Eloquent\Model;

class EloquentComment implements CommentInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $comment;

    public function __construct(Model $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Accept new comment data that will be persisted in data source
     *
     * @param Comment $comment
     * @return \Ss\Repositories\Comment\Comment
     * @throws CommentNotSavedException
     */
    public function save(Comment $comment)
    {
        $comment->save();

        if (!$comment->id) {
            throw new CommentNotSavedException('The comment was not saved.');
        }

        return $comment;
    }
}
