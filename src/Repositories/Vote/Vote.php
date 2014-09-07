<?php
namespace Ss\Repositories\Vote;

use Ss\Domain\Vote\Events\VoteCast;
use Ss\Domain\Vote\Events\VoteChanged;
use Ss\Models\BaseModel;

class Vote extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'votes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'song_id', 'vote'];

    /**
     * A vote belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Ss\Repositories\User\User');
    }

    /**
     * A vote belongs to a song
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song()
    {
        return $this->belongsTo('Ss\Repositories\Song\Song');
    }

    /**
     * Cast a new vote for a song
     *
     * @param $song_id
     * @param $user_id
     * @param $vote
     * @return static
     */
    public static function cast($song_id, $user_id, $vote)
    {
        $oldVote = self::where('song_id', $song_id)->where('user_id', $user_id)->first();
        if ($oldVote) {
            $newVote = $oldVote;

            if ($oldVote->vote != $vote) {
                $newVote->vote = $vote;

                $newVote->raise(new VoteChanged($newVote));
            }
        } else {
            // create a new vote
            $newVote = new static(compact('song_id', 'user_id', 'vote'));

            $newVote->raise(new VoteCast($newVote));
        }

        return $newVote;
    }
} 