<?php

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('log out of the application');

// Log into the system
Auth::loginUsingId(1);
$I->seeAuthentication();

$I->amOnRoute('home');
$I->click('Logout');

$I->amOnRoute('login');