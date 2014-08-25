<?php

$I = new FunctionalTester($scenario);
$I->am('guest');
$I->wantTo('sign into my account');

$I->loginUser($I);

$I->see('Welcome to the song suggester!');

$I->seeAuthentication();