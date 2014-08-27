<?php
namespace Ss\Repositories\Song;

use Laracasts\Commander\Events\EventGenerator;
use Ss\Domain\Suggestion\Events\SongEdited;
use Ss\Domain\Suggestion\Events\SongSuggested;
use Ss\Models\BaseModel;

class Song extends BaseModel
{
    use EventGenerator;

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
        return $this->belongsTo('Ss\Models\User');
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

    public static function edit(Song $song, $artist, $title)
    {
        $song->artist = $artist;
        $song->title = $title;

        $song->raise(new SongEdited($song));

        return $song;
    }
} 