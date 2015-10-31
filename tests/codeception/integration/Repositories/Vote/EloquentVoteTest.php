<?php

use Laracasts\TestDummy\Factory as TestDummy;

class EloquentVoteTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = $this->tester->grabService('Ss\Repositories\Vote\VoteInterface');
    }

    /** @test */
    public function get_all_votes()
    {
        $users = TestDummy::times(2)->create('Ss\Repositories\User\User');

        TestDummy::times(2)->create(
            'Ss\Repositories\Vote\Vote',
            [
                'user_id' => $users[0]->id,
            ]
        );

        TestDummy::times(2)->create(
            'Ss\Repositories\Vote\Vote',
            [
                'user_id' => $users[1]->id,
            ]
        );

        $allVotes = $this->repo->all();

        $this->assertCount(4, $allVotes);
    }

    /** @test */
    public function get_by_id()
    {
        $vote = TestDummy::create('Ss\Repositories\Vote\Vote');

        $repoVote = $this->repo->byId($vote->id);

        $this->assertEquals($vote->song_id, $repoVote->song_id);
    }

    /**
     * @test
     * @expectedException Ss\Repositories\Vote\VoteNotFoundException
     */
    public function find_vote_by_id_but_not_found()
    {
        $this->repo->byId(0);
    }

    /** @test */
    public function save_a_vote()
    {
        $vote = TestDummy::create('Ss\Repositories\Vote\Vote', ['vote' => 'y']);

        $newVote = 'n';

        $vote->vote = $newVote;

        $repoVote = $this->repo->save($vote);

        $this->assertEquals($repoVote->vote, $newVote);
    }

    /** @test */
    public function delete_a_vote()
    {
        $vote = TestDummy::create('Ss\Repositories\Vote\Vote');

        $deleted = $this->repo->delete($vote);

        $this->assertTrue($deleted);
    }
}
