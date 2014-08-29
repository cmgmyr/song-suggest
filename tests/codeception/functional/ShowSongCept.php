<?php

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('see a song');

$I->signIn();
$song = $I->haveASong();

$I->amOnRoute('songs.show', array('id' => $song->id));

$I->see($song->title);
$I->see('by ' . $song->artist);