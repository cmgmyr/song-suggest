<?php

use Laracasts\TestDummy\Factory as TestDummy;

class EloquentSongTest extends \Codeception\TestCase\Test
{

    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = $this->tester->grabService('Ss\Repositories\Song\SongInterface');
    }

    /** @test */
    public function get_all_songs()
    {
        $users = TestDummy::times(2)->create('Ss\Models\User');

        TestDummy::times(2)->create(
            'Ss\Repositories\Song\Song',
            [
                'user_id' => $users[0]->id
            ]
        );

        TestDummy::times(2)->create(
            'Ss\Repositories\Song\Song',
            [
                'user_id' => $users[1]->id
            ]
        );

        $allSongs = $this->repo->all();

        $this->assertCount(4, $allSongs);
    }

}