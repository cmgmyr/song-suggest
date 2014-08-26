<?php

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('add a new song');

$I->loginUser($I);

$I->click('Add Song');
$I->amOnRoute('songs.create');

$I->fillField('artist', 'Metallica');
$I->fillField('title', 'Enter Sandman');
$I->click('Save!');

$I->amOnRoute('home');
$I->seeInSession('flash_notification.message', 'Your song suggestion has been added!');