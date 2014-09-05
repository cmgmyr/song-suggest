<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use FunctionalTester;
use Laracasts\TestDummy\Factory as TestDummy;

class FunctionalHelper extends \Codeception\Module
{
    public function _beforeSuite($settings = array())
    {
        $this->debug('MIGRATING BEFORE RUN');
        $I = $this->getModule('Laravel4');
        $artisan = $I->grabService('artisan');
        $artisan->call('migrate');
        $artisan->call('db:seed');
    }

    public function haveAnAccount($overrides = [])
    {
        return TestDummy::create('Ss\Repositories\User\User', $overrides);
    }

    public function signIn($email='test@test.com', $password='test123', $is_admin='n')
    {
        $user = $this->haveAnAccount(compact('email', 'password', 'is_admin'));

        $I = $this->getModule('Laravel4');

        $I->amOnRoute('login');
        $I->fillField('email', $email);
        $I->fillField('password', $password);
        $I->click('Login');
        $I->seeAuthentication();

        $I->amOnRoute('home');

        return $user;
    }

    public function signInAsAdmin()
    {
        $this->signIn('admin@test.com', 'admin123', 'y');
    }

    public function haveASong()
    {
        return TestDummy::create('Ss\Repositories\Song\Song');
    }

    public function haveAUser()
    {
        return TestDummy::create('Ss\Repositories\User\User');
    }
}