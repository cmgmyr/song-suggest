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
        $song->comments()->delete();
        $song->votes()->delete();
        $song->delete();

        return true;
    }

    /**
     * Get all comments and activities for a song
     *
     * @param Song $song
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActivities(Song $song)
    {
        // @todo: see if there is a better solution for all of this...

        $query = "
        SELECT id, 'comment' as 'type', user_id, comment, null as message, null as color_class, created_at FROM comments
        WHERE song_id = :comment_song_id
        UNION
        SELECT id, 'activity' as 'type', user_id, null as comment, message, color_class, created_at FROM activity
        WHERE song_id = :activity_song_id ORDER BY created_at DESC, id DESC
        ";

        $records = \DB::select(\DB::raw($query), ['comment_song_id' => $song->id, 'activity_song_id' => $song->id]);
        $data = new \Illuminate\Database\Eloquent\Collection;

        foreach($records as $record) {
            $record->user = \Ss\Repositories\User\User::find($record->user_id);

            $data->add($record);
        }

        return $data;
    }
} 