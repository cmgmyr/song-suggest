<?php

$artist = 'Metallica';
$title = 'Enter Sandman';

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('delete a song');

$I->signIn();

$I->click('Add Song');
$I->amOnRoute('songs.create');

$I->fillField('artist', $artist);
$I->fillField('title', $title);
$I->click('Save!');

$I->amOnRoute('home');
$I->seeInSession('flash_notification.message', 'Your song suggestion has been added!');
$I->see($title);

$I->click('Delete');

$I->amOnRoute('home');
$I->seeInSession('flash_notification.message', 'The song has been deleted.');
$I->dontSee($title);