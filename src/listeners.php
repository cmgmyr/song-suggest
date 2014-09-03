<?php

Event::listen('Ss.Domain.Song.Events.SongSuggested', 'Ss\Controllers\VotesController@whenSongWasSuggested');