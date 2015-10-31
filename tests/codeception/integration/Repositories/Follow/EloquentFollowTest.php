<?php

use Laracasts\TestDummy\Factory as TestDummy;

class EloquentFollowTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = $this->tester->grabService('Ss\Repositories\Follow\FollowInterface');
    }

    /** @test */
    public function save_a_follow()
    {
        $follow = TestDummy::create('Ss\Repositories\Follow\Follow');

        $repoFollow = $this->repo->save($follow);

        $this->assertTrue(is_integer($repoFollow->id));
    }

    /** @test */
    public function delete_a_follow()
    {
        $follow = TestDummy::create('Ss\Repositories\Follow\Follow');

        $deleted = $this->repo->delete($follow->song_id, $follow->user_id);

        $this->assertTrue($deleted);
    }
}
