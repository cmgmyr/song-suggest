<?php

$I = new FunctionalTester($scenario);
$I->am('guest');
$I->wantTo('sign into my account');

$I->signIn();

$I->see('Welcome to the song suggester!');

$I->seeAuthentication();