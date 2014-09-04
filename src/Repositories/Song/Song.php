<?php
namespace Ss\Repositories\Song;

use Ss\Domain\Song\Events\SongDeleted;
use Ss\Domain\Song\Events\SongEdited;
use Ss\Domain\Song\Events\SongSuggested;
use Ss\Models\BaseModel;
use Ss\Repositories\User\User;

class Song extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'songs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('artist', 'title', 'user_id');

    /**
     * Each song belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Ss\Repositories\User\User');
    }

    /**
     * A song has many votes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany('Ss\Repositories\Vote\Vote');
    }

    /**
     * Get all positive (yes) votes from a song
     *
     * @return mixed
     */
    public function positiveVotes()
    {
        return $this->votes()->where('vote', 'y');
    }

    /**
     * Get all negative (no) votes from a song
     *
     * @return mixed
     */
    public function negativeVotes()
    {
        return $this->votes()->where('vote', 'n');
    }

    /**
     * Get a user's vote for the song
     *
     * @param $user_id
     * @return mixed
     */
    public function voteByUser($user_id)
    {
        return $this->votes()->where('user_id', $user_id)->first();
    }

    /**
     * See if the song can be edited by the user
     *
     * @param User $user
     * @return bool
     */
    public function isEditable(User $user)
    {
        if ($user->is_admin == 'y' || $this->votes()->count() <= 1) {
            return true;
        }

        return false;
    }

    /**
     * See if the song can be deleted by the user
     *
     * @param User $user
     * @return bool
     */
    public function isDeletable(User $user)
    {
        if ($user->is_admin == 'y' || $user->id == $this->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Suggest a new song
     *
     * @param $artist
     * @param $title
     * @param $user_id
     * @return static
     * @internal param $user
     */
    public static function suggest($artist, $title, $user_id)
    {
        $song = new static(compact('artist', 'title', 'user_id'));

        $song->raise(new SongSuggested($song));

        return $song;
    }

    /**
     * Edit a current song
     *
     * @param Song $song
     * @param $artist
     * @param $title
     * @return Song
     */
    public static function edit(Song $song, $artist, $title)
    {
        $song->artist = $artist;
        $song->title = $title;

        $song->raise(new SongEdited($song));

        return $song;
    }

    /**
     * Delete a current song
     *
     * @param Song $song
     * @return Song
     */
    public static function deleteSong(Song $song)
    {
        $song->raise(new SongDeleted($song));

        return $song;
    }
} 