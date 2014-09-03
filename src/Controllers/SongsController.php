<?php
namespace Ss\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Ss\Core\CommandBus;
use Ss\Domain\Suggestion\DeleteSongCommand;
use Ss\Domain\Suggestion\EditSongCommand;
use Ss\Domain\Suggestion\SuggestSongCommand;
use Ss\Forms\SongForm;
use Ss\Repositories\Song\SongInterface;
use Ss\Repositories\Song\SongNotFoundException;

class SongsController extends BaseController
{

    use CommandBus;

    /**
     * @var \Ss\Repositories\Song\SongInterface
     */
    private $song;

    /**
     * @var \Ss\Forms\SongForm
     */
    protected $songForm;

    function __construct(SongInterface $song, SongForm $songForm)
    {
        $this->song = $song;
        $this->songForm = $songForm;
    }

    public function index()
    {
        $songs = $this->song->all();

        $this->layout->content = View::make('songs.index', compact('songs'));
    }

    public function create()
    {
        $song = new \stdClass();

        $this->layout->content = View::make('songs.create', compact('song'));
    }

    public function store()
    {
        $this->songForm->validate();

        extract(Input::only('artist', 'title'));
        $command = new SuggestSongCommand($artist, $title, Auth::user());
        $this->execute($command);

        return $this->redirectRouteWithSuccess('home', 'Your song suggestion has been added!');
    }

    public function show($id)
    {
        try {
            $song = $this->song->byId($id);

            $this->layout->content = View::make('songs.show', compact('song'));
        } catch (SongNotFoundException $e) {
            return $this->redirectRouteWithError('home', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $song = $this->song->byId($id);

            $this->layout->content = View::make('songs.edit', compact('song'));
        } catch (SongNotFoundException $e) {
            return $this->redirectRouteWithError('home', $e->getMessage());
        }
    }

    public function update($id)
    {
        $song = $this->song->byId($id);

        $this->songForm->validate();

        extract(Input::only('artist', 'title'));
        $command = new EditSongCommand($song, $artist, $title);
        $this->execute($command);

        return $this->redirectRouteWithSuccess('home', 'Your song suggestion has been updated!');
    }

    public function destroy($id)
    {
        try {
            $song = $this->song->byId($id);

            $command = new DeleteSongCommand($song);
            $this->execute($command);

            return $this->redirectRouteWithSuccess('home', 'The song has been deleted.');
        } catch (SongNotFoundException $e) {
            return $this->redirectRouteWithError('home', $e->getMessage());
        }
    }


}
