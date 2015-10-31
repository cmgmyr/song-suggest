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
        $users = TestDummy::times(2)->create('Ss\Repositories\User\User');

        TestDummy::times(2)->create(
            'Ss\Repositories\Song\Song',
            [
                'user_id' => $users[0]->id,
            ]
        );

        TestDummy::times(2)->create(
            'Ss\Repositories\Song\Song',
            [
                'user_id' => $users[1]->id,
            ]
        );

        $allSongs = $this->repo->all();

        $this->assertCount(4, $allSongs);
    }

    /** @test */
    public function get_by_id()
    {
        $song = TestDummy::create('Ss\Repositories\Song\Song');

        $repoSong = $this->repo->byId($song->id);

        $this->assertEquals($song->title, $repoSong->title);
    }

    /**
     * @test
     * @expectedException Ss\Repositories\Song\SongNotFoundException
     */
    public function find_song_by_id_but_not_found()
    {
        $this->repo->byId(0);
    }

    /** @test */
    public function save_a_song()
    {
        $song = TestDummy::create('Ss\Repositories\Song\Song');

        $newTitle = 'My new title';

        $song->title = $newTitle;

        $repoSong = $this->repo->save($song);

        $this->assertEquals($repoSong->title, $newTitle);
    }

    /** @test */
    public function delete_a_song()
    {
        $song = TestDummy::create('Ss\Repositories\Song\Song');

        $deleted = $this->repo->delete($song);

        $this->assertTrue($deleted);
    }

    /** @test */
    public function get_deleted_song()
    {
        $song = TestDummy::create('Ss\Repositories\Song\Song');

        $deleted = $this->repo->delete($song);

        $this->assertTrue($deleted);

        $deletedSong = $this->repo->deletedWithId($song->id);

        $this->assertEquals($song->id, $deletedSong->id);
    }

    /** @test */
    public function restore_song()
    {
        $song = TestDummy::create('Ss\Repositories\Song\Song');

        $deleted = $this->repo->delete($song);

        $this->assertTrue($deleted);

        $restored = $this->repo->restore($song);

        $this->assertTrue($restored);
    }

    /** @test */
    public function force_delete_a_song()
    {
        $song = TestDummy::create('Ss\Repositories\Song\Song');

        $deleted = $this->repo->forceDelete($song);

        $this->assertTrue($deleted);

        $I = $this->getModule('Laravel4');
        $I->dontSeeRecord('songs', array('id' => $song->id));
    }

    /**
     * @test
     * @expectedException Ss\Repositories\Song\SongNotFoundException
     */
    public function find_deleted_song_by_id_but_not_found()
    {
        $this->repo->deletedWithId(0);
    }
}
