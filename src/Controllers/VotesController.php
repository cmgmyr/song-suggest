<?php namespace Ss\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Ss\Domain\Vote\VoteCastCommand;
use Ss\Forms\VoteForm;
use Ss\Repositories\Vote\Vote;

class VotesController extends BaseController
{

    protected $vote;
    protected $voteForm;

    function __construct(Vote $vote, VoteForm $voteForm)
    {
        $this->vote = $vote;
        $this->voteForm = $voteForm;
    }

    /**
     * Casts a new vote from the song details page
     *
     * @param $songId
     * @return mixed
     */
    public function store($songId)
    {
        $this->voteForm->validate();
        $input = ['song_id' => $songId, 'user_id' => Auth::id(), 'vote' => Input::get('vote')];
        $this->execute(VoteCastCommand::class, $input);

        return $this->redirectBackWithSuccess('Your vote has been cast!');
    }

    /**
     * Adds a new vote for the song that was just suggested
     *
     * @param $event
     */
    public function whenSongWasSuggested($event)
    {
        $input = ['song_id' => $event->song->id, 'user_id' => $event->song->user_id, 'vote' => 'y'];
        $this->execute(VoteCastCommand::class, $input);
    }

}