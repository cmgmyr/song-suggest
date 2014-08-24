<?php

$I = new FunctionalTester($scenario);
$I->am('guest');
$I->wantTo('sign into my account');

$I->amOnRoute('login');

$I->fillField('Email Address', 'chris@modomediagroup.com');
$I->fillField('Password', 'password123');
$I->click('Login');

$I->seeCurrentUrlEquals('');
$I->see('Welcome to the song suggester!');

$I->seeAuthentication();