<?php
use \FunctionalTester;

class SongCrudCest
{

    public function _before(FunctionalTester $I)
    {
        $I->signIn();
    }

    // tests
    public function createSong(FunctionalTester $I)
    {
        $I->click('Add Song');
        $I->amOnRoute('songs.create');

        $I->fillField('artist', 'Metallica');
        $I->fillField('title', 'Enter Sandman');
        $I->click('Save!');

        $I->amOnRoute('home');
        $I->seeInSession('flash_notification.message', 'Your song suggestion has been added!');
    }

    public function editSong(FunctionalTester $I)
    {
        $song = $I->haveASong();

        $I->amOnRoute('songs.edit', array('id' => $song->id));

        $I->fillField('artist', 'Metallica');
        $I->fillField('title', 'Enter Sandman');
        $I->click('Save!');

        $I->amOnRoute('home');
        $I->seeInSession('flash_notification.message', 'Your song suggestion has been updated!');
    }

    public function EditSongWithError(FunctionalTester $I)
    {
        $id = 0;

        $I->amOnRoute('songs.edit', array('id' => $id));

        $I->amOnRoute('home');
        $I->see('No song found with ID: ' . $id);
    }

    public function showSong(FunctionalTester $I)
    {
        $song = $I->haveASong();

        $I->amOnRoute('songs.show', array('id' => $song->id));

        $I->see($song->title);
        $I->see('by ' . $song->artist);
    }

    public function showSongWithError(FunctionalTester $I)
    {
        $id = 0;

        $I->amOnRoute('songs.show', array('id' => $id));

        $I->amOnRoute('home');
        $I->see('No song found with ID: ' . $id);
    }

    public function deleteSong(FunctionalTester $I)
    {
        $artist = 'Metallica';
        $title = 'Enter Sandman';

        $I->click('Add Song');
        $I->amOnRoute('songs.create');

        $I->fillField('artist', $artist);
        $I->fillField('title', $title);
        $I->click('Save!');

        $I->amOnRoute('home');
        $I->seeInSession('flash_notification.message', 'Your song suggestion has been added!');
        $I->see($title);

        $I->click('Delete');

        $I->amOnRoute('home');
        $I->seeInSession('flash_notification.message', 'The song has been deleted.');
        $I->dontSee($title);
    }
}