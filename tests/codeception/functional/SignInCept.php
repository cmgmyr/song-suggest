<?php

$I = new FunctionalTester($scenario);
$I->am('guest');
$I->wantTo('sign into my account');

$I->signIn();

$I->see('Songs');

$I->seeAuthentication();