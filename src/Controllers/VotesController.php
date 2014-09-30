<?php namespace Ss\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Ss\Domain\Song\SongCategoryChangedCommand;
use Ss\Domain\Vote\VoteCastCommand;
use Ss\Forms\VoteForm;
use Ss\Repositories\Category\Category;
use Ss\Repositories\Song\SongInterface;
use Ss\Repositories\Vote\Vote;

class VotesController extends BaseController
{

    protected $song;
    protected $vote;
    protected $voteForm;

    function __construct(SongInterface $song, Vote $vote, VoteForm $voteForm)
    {
        $this->song = $song;
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

    /**
     * Potentially moves a song to a new category after a vote was cast
     *
     * @param $event
     */
    public function whenVoteWasCast($event)
    {
        // get the song
        $song = $this->song->byId($event->vote->song_id);

        // find the positive votes
        $positiveVotes = $song->positiveVotes();

        // find negative votes
        $negativeVotes = $song->negativeVotes();

        // get threshold
        $threshold = Config::get('settings.threshold');

        // see if song is negative or positive, then move to category
        if (!in_array($song->category_id, Category::getProtectedCategories())) {
            if($positiveVotes >= $threshold) {
                $input = ['song' => $song, 'category_id' => Category::APPROVED];
                $this->execute(SongCategoryChangedCommand::class, $input);
            } else if ($negativeVotes >= $threshold) {
                $input = ['song' => $song, 'category_id' => Category::DECLINED];
                $this->execute(SongCategoryChangedCommand::class, $input);
            } else {
                $input = ['song' => $song, 'category_id' => Category::PENDING];
                $this->execute(SongCategoryChangedCommand::class, $input);
            }
        }
    }

}