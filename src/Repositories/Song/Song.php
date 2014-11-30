<?php
namespace Ss\Repositories\Song;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Support\Facades\Config;
use Ss\Domain\Song\Events\SongCategoryChanged;
use Ss\Domain\Song\Events\SongDeleted;
use Ss\Domain\Song\Events\SongEdited;
use Ss\Domain\Song\Events\SongRestored;
use Ss\Domain\Song\Events\SongSuggested;
use Ss\Domain\Song\Events\SongVotesReset;
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
    protected $fillable = ['artist', 'title', 'user_id', 'youtube', 'category_id', 'mp3_file', 'reminded_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['reminded_at', 'created_at', 'updated_at', 'deleted_at'];

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
     * Each song belongs to a category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Ss\Repositories\Category\Category');
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
     * Count all positive (yes) votes from a song
     *
     * @return mixed
     */
    public function positiveVotes()
    {
        return $this->votes()->where('vote', 'y')->count();
    }

    /**
     * Count all negative (no) votes from a song
     *
     * @return mixed
     */
    public function negativeVotes()
    {
        return $this->votes()->where('vote', 'n')->count();
    }

    /**
     * Get all positive (yes) users from a song
     *
     * @return mixed
     */
    public function positiveVoteUsers()
    {
        return $this->votes()->where('vote', 'y')->with('user')->oldest()->get();
    }

    /**
     * Get all negative (no) users from a song
     *
     * @return mixed
     */
    public function negativeVoteUsers()
    {
        return $this->votes()->where('vote', 'n')->with('user')->oldest()->get();
    }

    /**
     * Count all votes on a song
     *
     * @return mixed
     */
    public function totalVotes()
    {
        return $this->votes()->count();
    }

    /**
     * Count all comments from a song
     *
     * @return mixed
     */
    public function commentsCount()
    {
        return $this->comments()->count();
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
     * Returns all followers of a song, except for user id given
     *
     * @param null $user_id
     * @return mixed
     */
    public function getFollowers($user_id = null)
    {
        $query = $this->follows()->whereHas('user', function($q)
            {
                $q->where('notify', 'y');
            });

        if ($user_id !== null) {
            $query->where('user_id', '!=', $user_id);
        }

        return $query->get();
    }

    /**
     * See if the song can be edited by the user
     *
     * @param User $user
     * @return bool
     */
    public function isEditable(User $user)
    {
        if ($user->is_admin == 'y' || $this->totalVotes() <= 1) {
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
     * @param $mp3_file
     * @param $user_id
     * @return static
     * @internal param $user
     */
    public static function suggest($artist, $title, $youtube, $mp3_file = null, $user_id)
    {
        $song = new static(compact('artist', 'title', 'youtube', 'mp3_file', 'user_id', 'reminded_at'));

        $song = self::updateRemindedAt($song);

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
     * @param $mp3_file
     * @return Song
     */
    public static function edit(Song $song, User $editor, $artist, $title, $youtube, $mp3_file)
    {
        $song->artist = $artist;
        $song->title = $title;
        $song->youtube = $youtube;

        // only overwrite the file if not currently available
        if ($song->mp3_file === null) {
            $song->mp3_file = $mp3_file;
        }

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
    public static function restoreSong(Song $song, User $editor)
    {
        $song->raise(new SongRestored($song, $editor));

        return $song;
    }

    /**
     * Updates the category of a song
     *
     * @param Song $song
     * @param $category_id
     * @return Song
     */
    public static function updateCategory(Song $song, $category_id)
    {
        if($song->category_id != $category_id) {
            $song->category_id = $category_id;

            $song->raise(new SongCategoryChanged($song));
        }

        return $song;
    }

    /**
     * Updates the reminded_at date for the song
     *
     * @param Song $song
     * @return Song
     */
    public static function updateRemindedAt(Song $song)
    {
        $song->reminded_at = Carbon::now()->addDays(Config::get('settings.vote_reminder_days'));

        return $song;
    }

    /**
     * Resets the votes for a given song
     *
     * @param Song $song
     * @return Song
     */
    public static function resetVotes(Song $song)
    {
        $song->votes()->delete();

        $song->raise(new SongVotesReset($song));

        return $song;
    }
} 