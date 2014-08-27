<?php

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('log out of the application');

$I->signIn();

$I->click('Logout');

$I->amOnRoute('login');