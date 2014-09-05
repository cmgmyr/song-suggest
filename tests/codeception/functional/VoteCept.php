<?php

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('vote for a song');

$user = $I->signIn();

$song = $I->haveASong();

$I->amOnRoute('songs.show', ['id' => $song->id]);

$I->selectOption('form input[name=vote]', 'y');
$I->click('Vote!');

$I->see('Your vote has been cast!');

$I->selectOption('form input[name=vote]', 'n');
$I->click('Vote!');

$I->see('Your vote has been cast!');