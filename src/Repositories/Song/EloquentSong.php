<?php
namespace Ss\Repositories\Song;

use Illuminate\Database\Eloquent\Model;

class EloquentSong implements SongInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $song;

    function __construct(Model $song)
    {
        $this->song = $song;
    }

    /**
     * Fetches all songs from data source
     *
     * @return object
     */
    public function all()
    {
        return $this->song->all();
    }

    /**
     * Fetches and returns song data associated with an id
     *
     * @param $id
     * @return object
     * @throws SongNotFoundException
     */
    public function byId($id)
    {
        $song = $this->song->find($id);
        if (!$song) {
            throw new SongNotFoundException('No song found with ID: ' . $id);
        }

        return $song;
    }

    /**
     * Accept new song data that will be persisted in data source
     *
     * @param Song $song
     * @return \Ss\Repositories\Song\Song
     * @throws SongNotSavedException
     */
    public function save(Song $song)
    {
        $song->save();

        if (!$song->id) {
            throw new SongNotSavedException('The song was not saved.');
        }

        return $song;
    }

    /**
     * Removes a song from data source
     *
     * @param Song $song
     * @return boolean
     */
    public function delete(Song $song)
    {
        $song->activities()->delete();
        $song->votes()->delete();
        $song->delete();

        return true;
    }
} 