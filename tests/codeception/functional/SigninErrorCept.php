<?php

$I = new FunctionalTester($scenario);
$I->am('guest');
$I->wantTo('attempt to sign in');

$I->amOnRoute('login');

$I->fillField('Email Address', 'bad@email.com');
$I->fillField('Password', 'nada123');
$I->click('Login');

$I->amOnRoute('login');
$I->see('Sorry, your login credentials were not correct, or you are not allowed to log in');