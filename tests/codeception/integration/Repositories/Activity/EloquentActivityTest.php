<?php

use Laracasts\TestDummy\Factory as TestDummy;

class EloquentActivityTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = $this->tester->grabService('Ss\Repositories\Activity\ActivityInterface');
    }

    /** @test */
    public function save_a_activity()
    {
        $activity = TestDummy::create('Ss\Repositories\Activity\Activity', ['message' => 'New Message']);

        $newActivity = 'Another new message';

        $activity->message = $newActivity;

        $repoActivity = $this->repo->save($activity);

        $this->assertEquals($repoActivity->message, $newActivity);
    }
}
