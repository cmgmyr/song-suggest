<?php

$I = new FunctionalTester($scenario);
$I->am('guest');
$I->wantTo('update my account');

$I->signIn();

$I->click('Update Account');

$I->amOnRoute('account');
$I->fillField('First Name', 'Test');
$I->fillField('Last Name', 'User');
$I->click('Save!');

$I->amOnRoute('home');
$I->see('Your account has been updated!');