<?php
namespace Ss\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Ss\Core\CommandBus;
use Ss\Domain\Suggestion\SuggestSongCommand;
use Ss\Forms\SongForm;

class SongsController extends BaseController
{

    use CommandBus;

    /**
     * @var \Ss\Forms\SongForm
     */
    protected $songForm;

    function __construct(SongForm $songForm)
    {
        $this->songForm = $songForm;
    }

    public function index()
    {
        //
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
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


}
