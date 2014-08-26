<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use FunctionalTester;

class FunctionalHelper extends \Codeception\Module
{
    public function loginUser(FunctionalTester $i)
    {
        $this->login($i, 'test@test.com', 'test123');
    }

    public function login(FunctionalTester $i, $email, $password)
    {
        $i->amOnRoute('login');
        $i->fillField('email', $email);
        $i->fillField('password', $password);
        $i->click('Login');
        $i->seeAuthentication();

        $i->amOnRoute('home');
    }
}