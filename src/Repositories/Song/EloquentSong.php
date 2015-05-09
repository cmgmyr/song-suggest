<?php
namespace Ss\Repositories\Song;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ss\Services\Media\Embeder;

class EloquentSong implements SongInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $song;

    public function __construct(Model $song)
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
        return $this->song->latest()->get();
    }

    /**
     * Fetches all deleted songs from data source
     *
     * @return object
     */
    public function deleted()
    {
        return $this->song->onlyTrashed()->get();
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
        $song->delete();

        return true;
    }

    /**
     * Fetches and returns song data associated with a deleted id
     *
     * @param $id
     * @return object
     * @throws SongNotFoundException
     */
    public function deletedWithId($id)
    {
        $song = $this->song->withTrashed()->where('id', $id)->first();
        if (!$song) {
            throw new SongNotFoundException('No deleted song found with ID: ' . $id);
        }

        return $song;
    }

    /**
     * Restores a song from being deleted
     *
     * @param Song $song
     * @internal param $id
     * @return boolean
     */
    public function restore(Song $song)
    {
        $song->restore();

        return true;
    }

    /**
     * Removes a song from data source
     *
     * @param Song $song
     * @internal param $id
     * @return boolean
     */
    public function forceDelete(Song $song)
    {
        $song->activities()->delete();
        $song->comments()->delete();
        $song->follows()->delete();
        $song->votes()->delete();
        $song->forceDelete();

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
        SELECT id, 'comment' as 'type', user_id, comment as text, null as color_class, created_at FROM comments
        WHERE song_id = :comment_song_id
        UNION
        SELECT id, 'activity' as 'type', user_id, message as text, color_class, created_at FROM activity
        WHERE song_id = :activity_song_id ORDER BY created_at DESC, id DESC
        ";

        $records = \DB::select(\DB::raw($query), ['comment_song_id' => $song->id, 'activity_song_id' => $song->id]);
        $data = new \Illuminate\Database\Eloquent\Collection;

        foreach ($records as $record) {
            $record->user = \Ss\Repositories\User\User::withTrashed()->where('id', $record->user_id)->first();
            $record->created_at = new Carbon($record->created_at);
            $record->text = Embeder::embed($record->text);

            $data->add($record);
        }

        return $data;
    }

    /**
     * Fetches all songs that need reminders sent to users
     *
     * @param int $days
     * @return object
     */
    public function remindable($days = 3)
    {
        return $this->song
            ->where(function ($q) use ($days) {
                $q->where('reminded_at', '<=', Carbon::now()->subDays($days)->toDateTimeString());
                $q->orWhere('reminded_at', null);
            })
            ->oldest('reminded_at')
            ->get();
    }

    public function getArtistsApi($query)
    {
        return $this->song
            ->select(\DB::raw('DISTINCT artist'))
            ->where('artist', 'LIKE', '%' . $query . '%')
            ->orderBy('artist', 'ASC')
            ->get();
    }
}
