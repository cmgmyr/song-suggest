<?php
namespace Ss\Repositories\Song;

use Laracasts\Commander\Events\EventGenerator;
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
} 