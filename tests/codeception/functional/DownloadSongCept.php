<?php

$I = new FunctionalTester($scenario);
$I->am('a user');
$I->wantTo('download a song');

$user = $I->signIn();

$song = $I->haveASong();

$I->amOnRoute('songs.show', ['id' => $song->id]);

$I->see('Download MP3');
