<?php namespace Ss\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Ss\Domain\Follow\FollowSongCommand;
use Ss\Domain\Follow\UnFollowSongCommand;
use Ss\Repositories\Follow\Follow;

class FollowsController extends BaseController
{

    protected $follow;

    function __construct(Follow $follow)
    {
        $this->follow = $follow;
    }

    /**
     * Follows a song
     *
     * @param $songId
     * @return mixed
     */
    public function store($songId)
    {
        $input = ['song_id' => $songId, 'user_id' => Auth::id()];

        if(Input::get('follow') == 'y') {
            $this->execute(FollowSongCommand::class, $input);

            return $this->redirectBackWithSuccess('You have started following this song!');
        } else {
            $this->execute(UnFollowSongCommand::class, $input);

            return $this->redirectBackWithSuccess('You have unfollowed this song!');
        }
    }

    /**
     * Follows the song that was just suggested
     *
     * @param $event
     */
    public function whenSongWasSuggested($event)
    {
        $input = ['song_id' => $event->song->id, 'user_id' => $event->song->user_id];
        $this->execute(FollowSongCommand::class, $input);
    }

}