<?php

class EloquentCategoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = $this->tester->grabService('Ss\Repositories\Category\CategoryInterface');
    }

    /** @test */
    public function get_all_categories()
    {
        $all = $this->repo->all();

        $this->assertCount(6, $all);
    }
}
