<?php

Event::subscribe('Ss\Listeners\ActivitiesListener');

Event::listen('Ss.Domain.Song.Events.SongSuggested', 'Ss\Controllers\FollowsController@whenSongWasSuggested');
Event::listen('Ss.Domain.Song.Events.SongSuggested', 'Ss\Controllers\VotesController@whenSongWasSuggested');

Event::listen('Ss.Domain.Vote.Events.*', 'Ss\Controllers\VotesController@whenVoteWasCast');

Event::listen('Ss.*', 'Ss\Listeners\EmailNotifier');