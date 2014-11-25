<?php
namespace Ss\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Ss\Domain\Song\ChangeCategoryCommand;
use Ss\Domain\Song\DeleteSongCommand;
use Ss\Domain\Song\EditSongCommand;
use Ss\Domain\Song\ForceDeleteSongCommand;
use Ss\Domain\Song\RestoreSongCommand;
use Ss\Domain\Song\SuggestSongCommand;
use Ss\Forms\SongForm;
use Ss\Repositories\Category\CategoryInterface;
use Ss\Repositories\Song\SongInterface;
use Ss\Repositories\Song\SongNotFoundException;

class SongsController extends BaseController
{

    /**
     * @var \Ss\Repositories\Category\CategoryInterface
     */
    private $category;

    /**
     * @var \Ss\Repositories\Song\SongInterface
     */
    protected $song;

    /**
     * @var \Ss\Forms\SongForm
     */
    protected $songForm;

    function __construct(CategoryInterface $category, SongInterface $song, SongForm $songForm)
    {
        $this->category = $category;
        $this->song = $song;
        $this->songForm = $songForm;
    }

    /**
     * Shows all of the non-deleted songs
     */
    public function index()
    {
        $categories = $this->category->all();
        $unvoted = Auth::user()->unvotedSongs();

        $this->layout->content = View::make('songs.index', compact('categories', 'unvoted'));
    }

    /**
     * Shows all of the deleted songs
     */
    public function deleted()
    {
        $songs = $this->song->deleted();

        $this->layout->content = View::make('songs.deleted', compact('songs'));
    }

    /**
     * Shows the form to suggest a new song
     */
    public function create()
    {
        $song = new \stdClass();

        $this->layout->content = View::make('songs.create', compact('song'));
    }

    /**
     * Stores the song from the create form
     *
     * @return mixed
     * @throws \Ss\Services\Validation\FormValidationException
     */
    public function store()
    {
        $this->songForm->validate();

        $input = array_add(Input::except('mp3_file'), 'user', Auth::user());
        $input = $this->handleUpload($input);

        $song = $this->execute(SuggestSongCommand::class, $input);

        return $this->redirectRouteWithSuccess('songs.show', 'Your song suggestion has been added!', ['id' => $song->id]);
    }

    /**
     * Shows a song given an ID
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $userId = Auth::id();

            $song = $this->song->byId($id);
            $activities = $this->song->getActivities($song);
            $vote = $song->voteByUser($userId);
            $following = $song->followedByUser($userId);
            $categories = $this->category->all();

            $this->layout->content = View::make('songs.show', compact('song', 'activities', 'vote', 'following', 'categories'));
        } catch (SongNotFoundException $e) {
            return $this->redirectRouteWithError('home', $e->getMessage());
        }
    }

    /**
     * Shows an edit form for a song given the ID
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        try {
            $song = $this->song->byId($id);

            if (!$song->isEditable(Auth::user())) {
                $message = 'Sorry, this song cannot currently be edited or you don\'t have the correct access to do so.';
                return $this->redirectRouteWithError('songs.show', $message, ['id' => $id]);
            }

            $this->layout->content = View::make('songs.edit', compact('song'));
        } catch (SongNotFoundException $e) {
            return $this->redirectRouteWithError('home', $e->getMessage());
        }
    }

    /**
     * Updates a song from the edit page given the ID
     *
     * @param $id
     * @return mixed
     * @throws \Ss\Services\Validation\FormValidationException
     */
    public function update($id)
    {
        $song = $this->song->byId($id);

        $this->songForm->validate();

        $input = array_merge(Input::all(), ['song' =>$song, 'editor' => Auth::user()]);
        $input = $this->handleUpload($input);

        $this->execute(EditSongCommand::class, $input);

        return $this->redirectRouteWithSuccess('home', 'Your song suggestion has been updated!');
    }

    /**
     * Downloads the MP3 from a song
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        $song = $this->song->byId($id);

        return Response::download(Config::get('uploads.location') . '/'. $song->mp3_file);
    }

    /**
     * Deletes a song
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $song = $this->song->byId($id);

            if (!$song->isDeletable(Auth::user())) {
                $message = 'Sorry, this song cannot currently be deleted or you don\'t have the correct access to do so.';
                return $this->redirectRouteWithError('songs.show', $message, ['id' => $id]);
            }

            $this->execute(DeleteSongCommand::class, ['song' => $song, 'editor' => Auth::user()]);

            return $this->redirectRouteWithSuccess('home', 'The song has been deleted.');
        } catch (SongNotFoundException $e) {
            return $this->redirectRouteWithError('home', $e->getMessage());
        }
    }

    /**
     * Restores a song
     *
     * @param $id
     * @return mixed
     */
    public function restore($id)
    {
        try {
            $song = $this->song->deletedWithId($id);

            if (Auth::user()->is_admin != 'y') {
                $message = 'Sorry, this song cannot currently be restored or you don\'t have the correct access to do so.';
                return $this->redirectRouteWithError('songs.show', $message, ['id' => $id]);
            }

            $this->execute(RestoreSongCommand::class, ['song' => $song, 'editor' => Auth::user()]);

            return $this->redirectBackWithSuccess('The song has been restored.');
        } catch (SongNotFoundException $e) {
            return $this->redirectBackWithError($e->getMessage());
        }
    }

    /**
     * Force deletes a song from the database
     *
     * @param $id
     * @return mixed
     */
    public function forceDestroy($id)
    {
        try {
            $song = $this->song->deletedWithId($id);

            if (Auth::user()->is_admin != 'y') {
                $message = 'Sorry, this song cannot currently be deleted or you don\'t have the correct access to do so.';
                return $this->redirectRouteWithError('songs.show', $message, ['id' => $id]);
            }

            $this->execute(ForceDeleteSongCommand::class, ['song' => $song, 'editor' => Auth::user()]);

            return $this->redirectBackWithSuccess('The song has been deleted.');
        } catch (SongNotFoundException $e) {
            return $this->redirectBackWithError($e->getMessage());
        }
    }

    /**
     * Handles mp3 uploads from the create and edit forms
     *
     * @param $input
     * @return array
     */
    protected function handleUpload($input)
    {
        $input = array_merge($input, ['mp3_file' => null]);

        if (Input::hasFile('mp3_file')) {
            $file = Input::file('mp3_file');
            if($file->getClientOriginalExtension() == 'mp3') {
                $fileName = $input['artist'] . ' - ' . $input['title'] . '.mp3';
                $file->move(Config::get('uploads.location'), $fileName);

                $input = array_merge($input, ['mp3_file' => $fileName]);
            }
        }

        return $input;
    }

    /**
     * Changes the category of a song
     *
     * @param $id
     * @return mixed
     */
    public function category($id)
    {
        try {
            $song = $this->song->deletedWithId($id);

            if (Auth::user()->is_admin != 'y') {
                $message = 'Sorry, this song cannot currently be deleted or you don\'t have the correct access to do so.';
                return $this->redirectRouteWithError('songs.show', $message, ['id' => $id]);
            }

            $this->execute(ChangeCategoryCommand::class, ['song' => $song, 'category' => Input::get('category_id')]);

            return $this->redirectBackWithSuccess('The song has been updated.');
        } catch (SongNotFoundException $e) {
            return $this->redirectBackWithError($e->getMessage());
        }
    }
}