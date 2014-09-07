<?php
namespace Ss\Repositories\Comment;

use Ss\Domain\Comment\Events\CommentPublished;
use Ss\Models\BaseModel;

class Comment extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'song_id', 'comment'];

    /**
     * A comment belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Ss\Repositories\User\User');
    }

    /**
     * A comment belongs to a song
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song()
    {
        return $this->belongsTo('Ss\Repositories\Song\Song');
    }

    /**
     * Publish a new comment for a song
     *
     * @param $song_id
     * @param $user_id
     * @param $comment
     * @return static
     */
    public static function publish($song_id, $user_id, $comment)
    {
        $newComment = new static(compact('song_id', 'user_id', 'comment'));

        $newComment->raise(new CommentPublished($newComment));

        return $newComment;
    }
} 