<?php

$I = new FunctionalTester($scenario);
$I->am('a user');
$I->wantTo('comment on a song');

$user = $I->signIn();

$song = $I->haveASong();

$I->amOnRoute('songs.show', ['id' => $song->id]);

$comment = 'This is my new comment';
$I->fillField('comment', $comment);
$I->click('Post Comment');

$I->see('Your comment has been added!');

$I->see($comment);
