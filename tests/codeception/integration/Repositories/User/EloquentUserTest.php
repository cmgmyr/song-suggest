<?php

use Laracasts\TestDummy\Factory as TestDummy;

class EloquentUserTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = $this->tester->grabService('Ss\Repositories\User\UserInterface');
    }

    /** @test */
    public function get_all_users()
    {
        $users = TestDummy::times(2)->create('Ss\Repositories\User\User');

        $allUsers = $this->repo->all();

        $this->assertCount(2, $allUsers);
    }

    /** @test */
    public function count_all_users()
    {
        TestDummy::times(2)->create('Ss\Repositories\User\User', ['is_active' => 'y']);
        TestDummy::times(2)->create('Ss\Repositories\User\User', ['is_active' => 'n']);

        $allUsers = $this->repo->countAll();

        $this->assertEquals(2, $allUsers);
    }

    /** @test */
    public function get_by_id()
    {
        $user = TestDummy::create('Ss\Repositories\User\User');

        $repoUser = $this->repo->byId($user->id);

        $this->assertEquals($user->email, $repoUser->email);
    }

    /**
     * @test
     * @expectedException Ss\Repositories\User\UserNotFoundException
     */
    public function find_song_by_id_but_not_found()
    {
        $this->repo->byId(0);
    }

    /** @test */
    public function save_a_user()
    {
        $user = TestDummy::create('Ss\Repositories\User\User');

        $newEmail = 'user.test@example.com';

        $user->email = $newEmail;

        $repoEmail = $this->repo->save($user);

        $this->assertEquals($repoEmail->email, $newEmail);
    }

    /** @test */
    public function delete_a_user()
    {
        $user = TestDummy::create('Ss\Repositories\User\User');

        $deleted = $this->repo->delete($user);

        $this->assertTrue($deleted);
    }

    /** @test */
    public function get_all_emailable_users()
    {
        $user1 = TestDummy::create('Ss\Repositories\User\User', ['notify' => 'y']);
        $user2 = TestDummy::create('Ss\Repositories\User\User', ['notify' => 'n']);

        $users = $this->repo->getAllEmailableUsers();

        $this->assertCount(1, $users);
    }
}
