<?php

Event::subscribe('Ss\Listeners\ActivitiesListener');

Event::listen('Ss.Domain.Song.Events.SongSuggested', 'Ss\Controllers\VotesController@whenSongWasSuggested');

Event::listen('Ss.*', 'Ss\Listeners\EmailNotifier');