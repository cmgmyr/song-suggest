<?php

class UserCrudCest
{
    public function _before(FunctionalTester $I)
    {
        $I->signInAsAdmin();
    }

    // tests
    public function createUser(FunctionalTester $I)
    {
        $I->click('Users');
        $I->click('Create New');
        $I->amOnRoute('users.create');

        $I->fillField('first_name', 'Test');
        $I->fillField('last_name', 'User');
        $I->fillField('email', 'testaccount@yahoo.com');
        $I->fillField('password', 'test123');
        $I->fillField('password_confirm', 'test123');
        $I->click('Save!');

        $I->amOnRoute('users');
        $I->seeInSession('flash_notification.message', 'The user has been saved.');
    }

    public function UserEdit(FunctionalTester $I)
    {
        $user = $I->haveAUser();

        $I->amOnRoute('users.edit', array('id' => $user->id));

        $I->fillField('first_name', 'Test');
        $I->fillField('last_name', 'User');
        $I->click('Save!');

        $I->amOnRoute('users');
        $I->seeInSession('flash_notification.message', 'The user has been saved.');
    }

    public function showUserWithError(FunctionalTester $I)
    {
        $id = 0;

        $I->amOnRoute('users.edit', array('id' => $id));

        $I->amOnRoute('users');
        $I->see('No user found with ID: ' . $id);
    }

    public function deleteUser(FunctionalTester $I)
    {
        $first_name = 'Random First Name';
        $last_name = 'Random Last Name';

        $I->click('Users');
        $I->click('Create New');
        $I->amOnRoute('users.create');

        $I->fillField('first_name', $first_name);
        $I->fillField('last_name', $last_name);
        $I->fillField('email', 'testaccount@yahoo.com');
        $I->fillField('password', 'test123');
        $I->fillField('password_confirm', 'test123');
        $I->click('Save!');

        $I->amOnRoute('users');
        $I->seeInSession('flash_notification.message', 'The user has been saved.');
        $I->see($first_name);

        $I->click('Delete');

        $I->amOnRoute('home');
        $I->seeInSession('flash_notification.message', 'The user has been deleted.');
        $I->dontSee($first_name);
    }
}
