<?php namespace Ss\Listeners;

use Laracasts\Commander\CommanderTrait;
use Ss\Domain\Activity\CreateActivityCommand;

class ActivitiesListener
{

    use CommanderTrait;

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('Ss.Domain.Song.Events.SongDeleted', 'Ss\Listeners\ActivitiesListener@whenSongWasDeleted');
        $events->listen('Ss.Domain.Song.Events.SongEdited', 'Ss\Listeners\ActivitiesListener@whenSongWasEdited');
        $events->listen('Ss.Domain.Song.Events.SongSuggested', 'Ss\Listeners\ActivitiesListener@whenSongWasSuggested');
        $events->listen('Ss.Domain.Vote.Events.VoteCast', 'Ss\Listeners\ActivitiesListener@whenVoteWasCast');
        $events->listen('Ss.Domain.Vote.Events.VoteChanged', 'Ss\Listeners\ActivitiesListener@whenVoteWasChanged');
    }

    /**
     * Adds a new activity for the song that was just suggested
     *
     * @param $event
     */
    public function whenSongWasSuggested($event)
    {
        $message = 'suggested this song.';
        $this->setActivity($event->song->id, $event->song->user_id, $message, 'info');
    }

    public function whenSongWasDeleted($event)
    {
        // nothing for now
    }

    public function whenSongWasEdited($event)
    {
        $message = 'edited this song';
        $this->setActivity($event->song->id, $event->song->user_id, $message, 'info');
    }

    public function whenVoteWasCast($event)
    {
        if ($event->vote->vote == 'y') {
            $vote = 'Yes';
            $color_class = 'success';
        } else {
            $vote = 'No';
            $color_class = 'danger';
        }

        $message = 'voted "' . $vote . '".';
        $this->setActivity($event->vote->song_id, $event->vote->user_id, $message, $color_class);
    }

    public function whenVoteWasChanged($event)
    {
        if ($event->vote->vote == 'y') {
            $vote = 'Yes';
            $color_class = 'success';
        } else {
            $vote = 'No';
            $color_class = 'danger';
        }

        $message = 'changed their vote to "' . $vote . '".';
        $this->setActivity($event->vote->song_id, $event->vote->user_id, $message, $color_class);
    }

    protected function setActivity($song_id, $user_id, $message, $color_class='')
    {
        $input = ['song_id' => $song_id, 'user_id' => $user_id, 'message' => $message, 'color_class' => $color_class];
        $this->execute(CreateActivityCommand::class, $input);
    }

}