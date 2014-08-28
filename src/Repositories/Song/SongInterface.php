<?php
namespace Ss\Repositories\Song;

interface SongInterface
{
    /**
     * Fetches all songs from data source
     *
     * @return object
     */
    public function all();

    /**
     * Fetches and returns song data associated with an id
     *
     * @param $id
     * @return object
     * @throws SongNotFoundException
     */
    public function byId($id);

    /**
     * Accept new song data that will be persisted in data source
     *
     * @param Song $song
     * @return \Ss\Repositories\Song\Song
     * @throws SongNotSavedException
     */
    public function save(Song $song);

    /**
     * Removes a song from data source
     *
     * @param Song $song
     * @internal param $id
     * @return boolean
     */
    public function delete(Song $song);
} 