<?php

Event::listen(
    'Ss.Domain.Suggestion.Events.SongSuggested',
    function ($event) {
        // dd($event->song->title . ' has been created');
    }
);

Event::listen(
    'Ss.Domain.Suggestion.Events.SongEdited',
    function ($event) {
        //dd($event->song->title . ' has been updated');
    }
);