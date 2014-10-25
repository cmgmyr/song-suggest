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
        $events->listen('Ss.Domain.Song.Events.SongSuggested', 'Ss\Listeners\ActivitiesListener@whenSongWasSuggested');
        $events->listen('Ss.Domain.Song.Events.SongDeleted', 'Ss\Listeners\ActivitiesListener@whenSongWasDeleted');
        $events->listen('Ss.Domain.Song.Events.SongRestored', 'Ss\Listeners\ActivitiesListener@whenSongWasRestored');
        $events->listen('Ss.Domain.Song.Events.SongEdited', 'Ss\Listeners\ActivitiesListener@whenSongWasEdited');
        $events->listen('Ss.Domain.Vote.Events.VoteCast', 'Ss\Listeners\ActivitiesListener@whenVoteWasCast');
        $events->listen('Ss.Domain.Vote.Events.VoteChanged', 'Ss\Listeners\ActivitiesListener@whenVoteWasChanged');
    }

    /**
     * Adds a new activity for the song that was suggested
     *
     * @param $event
     */
    public function whenSongWasSuggested($event)
    {
        $message = 'suggested this song.';
        $this->setActivity($event->song->id, $event->song->user_id, $message, 'info');
    }

    /**
     * Adds a new activity for the song that was deleted
     *
     * @param $event
     */
    public function whenSongWasDeleted($event)
    {
        $message = 'deleted this song';
        $this->setActivity($event->song->id, $event->editor->id, $message, 'danger');
    }

    /**
     * Adds a new activity for the song that was restored
     *
     * @param $event
     */
    public function whenSongWasRestored($event)
    {
        $message = 'restored this song';
        $this->setActivity($event->song->id, $event->editor->id, $message, 'success');
    }

    /**
     * Adds a new activity for the song that was edited
     *
     * @param $event
     */
    public function whenSongWasEdited($event)
    {
        $message = 'edited this song';
        $this->setActivity($event->song->id, $event->editor->id, $message, 'info');
    }

    /**
     * Adds a new activity for when a vote was cast
     *
     * @param $event
     */
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

    /**
     * Adds a new activity for when a vote was changed
     *
     * @param $event
     */
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

    /**
     * Sets the activity for a song
     *
     * @param $song_id
     * @param $user_id
     * @param $message
     * @param string $color_class
     */
    protected function setActivity($song_id, $user_id, $message, $color_class='')
    {
        $input = ['song_id' => $song_id, 'user_id' => $user_id, 'message' => $message, 'color_class' => $color_class];
        $this->execute(CreateActivityCommand::class, $input);
    }

}