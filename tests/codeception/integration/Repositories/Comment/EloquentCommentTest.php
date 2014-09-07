<?php

use Laracasts\TestDummy\Factory as TestDummy;

class EloquentCommentTest extends \Codeception\TestCase\Test
{

    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = $this->tester->grabService('Ss\Repositories\Comment\CommentInterface');
    }

    /** @test */
    public function save_a_comment()
    {
        $comment = TestDummy::create('Ss\Repositories\Comment\Comment', ['comment' => 'This is a new comment']);

        $newComment = 'This is an even newer comment';

        $comment->comment = $newComment;

        $repoComment = $this->repo->save($comment);

        $this->assertEquals($repoComment->comment, $newComment);
    }

}