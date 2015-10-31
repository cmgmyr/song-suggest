<?php

class AdminSongCrudCest
{
    public function _before(FunctionalTester $I)
    {
        $I->signIn(null, null, 'y');
    }

    // tests
    public function resetSongVotes(FunctionalTester $I)
    {
        $song = $I->haveASong();

        $I->amOnRoute('songs.show', array('id' => $song->id));

        $I->click('Reset Votes');

        $I->seeInSession('flash_notification.message', 'The song votes have been reset, and changed to "Pending".');
    }
}
