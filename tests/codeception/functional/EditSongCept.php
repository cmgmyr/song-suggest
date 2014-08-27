<?php

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('edit a song');

$I->signIn();
$song = $I->haveASong();

$I->amOnRoute('songs.edit', array('id' => $song->id));

$I->fillField('artist', 'Metallica');
$I->fillField('title', 'Enter Sandman');
$I->click('Save!');

$I->amOnRoute('home');
$I->seeInSession('flash_notification.message', 'Your song suggestion has been updated!');