<?php
namespace Ss\Repositories\Follow;

use Ss\Models\BaseModel;

class Follow extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'follows';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'song_id'];

    /**
     * A follow belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Ss\Repositories\User\User')->withTrashed();
    }

    /**
     * A follow belongs to a song
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song()
    {
        return $this->belongsTo('Ss\Repositories\Song\Song');
    }

    /**
     * A user follows a song
     *
     * @param $song_id
     * @param $user_id
     * @return static
     */
    public static function follow($song_id, $user_id)
    {
        $follow = new static(compact('song_id', 'user_id'));

        return $follow;
    }
}
