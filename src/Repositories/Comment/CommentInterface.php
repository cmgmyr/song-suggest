<?php
namespace Ss\Repositories\Comment;

interface CommentInterface
{
    /**
     * Accept new comment data that will be persisted in data source
     *
     * @param Comment $comment
     * @internal param \Ss\Repositories\Vote\Vote $vote
     * @return \Ss\Repositories\Vote\Vote
     */
    public function save(Comment $comment);
}
