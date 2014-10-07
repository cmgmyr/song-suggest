<?php namespace Ss\Domain\Comment;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\Comment\Comment;
use Ss\Repositories\Comment\CommentInterface;

class CommentPublishedCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var CommentInterface
     */
    protected $comment;

    function __construct(CommentInterface $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $comment = Comment::publish($command->song_id, $command->user_id, $command->comment);

        $this->comment->save($comment);

        $this->dispatchEventsFor($comment);

        return $comment;
    }

}