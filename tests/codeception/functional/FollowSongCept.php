<?php

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('follow a song');

$user = $I->signIn();

$song = $I->haveASong();

$I->amOnRoute('songs.show', ['id' => $song->id]);

$I->submitForm('.follow-form', ['follow' => 'y']);
$I->see('You have started following this song!');

$I->submitForm('.follow-form', ['follow' => '']);
$I->see('You have unfollowed this song!');