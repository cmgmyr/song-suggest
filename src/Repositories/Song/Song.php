<?php
namespace Ss\Repositories\Song;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Ss\Domain\Song\Events\SongDeleted;
use Ss\Domain\Song\Events\SongEdited;
use Ss\Domain\Song\Events\SongRestored;
use Ss\Domain\Song\Events\SongSuggested;
use Ss\Models\BaseModel;
use Ss\Repositories\User\User;

class Song extends BaseModel
{

    use SoftDeletingTrait;

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
    protected $fillable = ['artist', 'title', 'user_id', 'youtube'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Song has many activities
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('Ss\Repositories\Activity\Activity')->latest()->latest('id');
    }

    /**
     * A song has many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Ss\Repositories\Comment\Comment');
    }

    /**
     * A song has many follows
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follows()
    {
        return $this->hasMany('Ss\Repositories\Follow\Follow');
    }

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
     * Sees if a user is following this song
     *
     * @param $user_id
     * @return bool
     */
    public function followedByUser($user_id)
    {
        $count = $this->follows()->where('user_id', $user_id)->count();

        if ($count == 0) {
            return false;
        }

        return true;
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
     * Parses the YouTube link and returns just the video id
     *
     * @return bool
     */
    public function getYouTubeId()
    {
        $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
        preg_match($pattern, $this->youtube, $matches);

        return (isset($matches[1])) ? $matches[1] : false;
    }

    /**
     * Suggest a new song
     *
     * @param $artist
     * @param $title
     * @param $youtube
     * @param $user_id
     * @return static
     * @internal param $user
     */
    public static function suggest($artist, $title, $youtube, $user_id)
    {
        $song = new static(compact('artist', 'title', 'youtube', 'user_id'));

        $song->raise(new SongSuggested($song));

        return $song;
    }

    /**
     * Edit a current song
     *
     * @param Song $song
     * @param \Ss\Repositories\User\User $editor
     * @param $artist
     * @param $title
     * @param $youtube
     * @return Song
     */
    public static function edit(Song $song, User $editor, $artist, $title, $youtube)
    {
        $song->artist = $artist;
        $song->title = $title;
        $song->youtube = $youtube;

        $song->raise(new SongEdited($song, $editor));

        return $song;
    }

    /**
     * Delete a current song
     *
     * @param Song $song
     * @param \Ss\Repositories\User\User $editor
     * @return Song
     */
    public static function deleteSong(Song $song, User $editor)
    {
        $song->raise(new SongDeleted($song, $editor));

        return $song;
    }

    /**
     * Restore a song
     *
     * @param Song $song
     * @param \Ss\Repositories\User\User $editor
     * @return Song
     */
    public static function RestoreSong(Song $song, User $editor)
    {
        $song->raise(new SongRestored($song, $editor));

        return $song;
    }
} 