<?php

use Laracasts\TestDummy\Factory as TestDummy;

class EloquentSettingTest extends \Codeception\TestCase\Test
{
    /**
     * @var \IntegrationTester
     */
    protected $tester;

    protected $repo;

    protected function _before()
    {
        $this->repo = $this->tester->grabService('Ss\Repositories\Setting\SettingInterface');
    }

    /** @test */
    public function get_by_key()
    {
        $setting = TestDummy::create('Ss\Repositories\Setting\Setting');

        $repoSetting = $this->repo->getByKey($setting->key);

        $this->assertEquals($setting->value, $repoSetting->value);
    }

    /**
     * @test
     * @expectedException Ss\Repositories\Setting\SettingNotFoundException
     */
    public function find_setting_by_key_but_not_found()
    {
        $this->repo->getByKey('no_fount');
    }

    /** @test */
    public function save_a_setting()
    {
        $setting = TestDummy::create('Ss\Repositories\Setting\Setting');

        $newValue = 'My new value';

        $setting->value = $newValue;

        $repoSetting = $this->repo->save($setting);

        $this->assertEquals($repoSetting->value, $newValue);
    }

    /** @test */
    public function update_voting_threshold()
    {
        $threshold = $this->repo->updateThreshold(1);
        $this->assertEquals(1, $threshold->value);

        $threshold = $this->repo->updateThreshold(3);
        $this->assertEquals(2, $threshold->value);

        $threshold = $this->repo->updateThreshold(2);
        $this->assertEquals(2, $threshold->value);

        $threshold = $this->repo->updateThreshold(5);
        $this->assertEquals(3, $threshold->value);
    }
}
