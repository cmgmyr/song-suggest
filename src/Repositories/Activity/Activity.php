<?php
namespace Ss\Repositories\Activity;

use Ss\Domain\Activity\Events\ActivityAdded;
use Ss\Models\BaseModel;

class Activity extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'song_id', 'message', 'color_class'];

    /**
     * An activity belongs to a song
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song()
    {
        return $this->belongsTo('Ss\Repositories\Song\Song');
    }

    /**
     * An activity belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Ss\Repositories\User\User');
    }

    public static function add($song_id, $user_id, $message, $color_class)
    {
        $activity = new static(compact('song_id', 'user_id', 'message', 'color_class'));

        $activity->raise(new ActivityAdded($activity));

        return $activity;
    }
}
