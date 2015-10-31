<?php

namespace Ss\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Ss\Domain\Comment\CommentPublishedCommand;
use Ss\Forms\CommentForm;

class CommentsController extends BaseController
{
    /**
     * @var CommentForm
     */
    protected $commentForm;

    public function __construct(CommentForm $commentForm)
    {
        $this->commentForm = $commentForm;
    }

    /**
     * Casts a new vote from the song details page.
     *
     * @param $songId
     * @return mixed
     */
    public function store($songId)
    {
        $this->commentForm->validate();
        $input = ['song_id' => $songId, 'user_id' => Auth::id(), 'comment' => Input::get('comment')];
        $this->execute(CommentPublishedCommand::class, $input);

        return $this->redirectBackWithSuccess('Your comment has been added!');
    }
}
