<?php

$I = new FunctionalTester($scenario);
$I->am('user');
$I->wantTo('see a song');

$I->signIn();

$id = 0;

$I->amOnRoute('songs.show', array('id' => $id));

$I->amOnRoute('home');
$I->see('No song found with ID: ' . $id);