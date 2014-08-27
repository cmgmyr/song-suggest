<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use FunctionalTester;
use Laracasts\TestDummy\Factory as TestDummy;

class FunctionalHelper extends \Codeception\Module
{

    public function haveAnAccount($overrides = [])
    {
        TestDummy::create('Ss\Models\User', $overrides);
    }

    public function signIn()
    {
        $email = 'test@test.com';
        $password = 'test123';

        $this->haveAnAccount(compact('email', 'password'));

        $I = $this->getModule('Laravel4');

        $I->amOnRoute('login');
        $I->fillField('email', $email);
        $I->fillField('password', $password);
        $I->click('Login');
        $I->seeAuthentication();

        $I->amOnRoute('home');
    }

    public function haveASong()
    {
        return TestDummy::create('Ss\Repositories\Song\Song');
    }
}