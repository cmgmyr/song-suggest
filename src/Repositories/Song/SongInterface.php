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
     * Fetches all deleted songs from data source
     *
     * @return object
     */
    public function deleted();

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
     * Soft deletes a song
     *
     * @param Song $song
     * @internal param $id
     * @return boolean
     */
    public function delete(Song $song);

    /**
     * Fetches and returns song data associated with a deleted id
     *
     * @param $id
     * @return object
     * @throws SongNotFoundException
     */
    public function deletedWithId($id);

    /**
     * Restores a song from being soft deleted
     *
     * @param Song $song
     * @internal param $id
     * @return boolean
     */
    public function restore(Song $song);

    /**
     * Removes a song from data source
     *
     * @param Song $song
     * @internal param $id
     * @return boolean
     */
    public function forceDelete(Song $song);

    /**
     * Fetches all songs that need reminders sent to users
     *
     * @param int $days
     * @return object
     */
    public function remindable($days = 3);
}
