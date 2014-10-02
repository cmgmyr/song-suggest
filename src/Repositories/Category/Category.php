<?php
namespace Ss\Repositories\Category;

use Ss\Models\BaseModel;

class Category extends BaseModel
{

    /**
     * ID for "Pending" category
     */
    const PENDING = 1;

    /**
     * ID for "Approved" category
     */
    const APPROVED = 2;

    /**
     * ID for "Declined" category
     */
    const DECLINED = 3;

    /**
     * ID for "Archived" category
     */
    const ARCHIVED = 4;

    /**
     * ID for "Learning" category
     */
    const LEARNING = 5;

    /**
     * ID for "Learned" category
     */
    const LEARNED = 6;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sort'];

    /**
     * Create and return protected categories. Songs in these categories
     * won't be moved to Approved/Declined
     *
     * @return array
     */
    public static function getProtectedCategories()
    {
        return [self::ARCHIVED, self::LEARNING, self::LEARNED];
    }

    /**
     * An category has many songs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function songs()
    {
        return $this->hasMany('Ss\Repositories\Song\Song', 'category_id');
    }

    public function popularSongs()
    {
        $records = \DB::select("
                SELECT
                    s.id,
                    (SELECT COUNT(id) FROM votes WHERE vote = 'y' AND song_id = s.id) as 'pos',
                    (SELECT COUNT(id) FROM votes WHERE vote = 'n' AND song_id = s.id) as 'neg',
                    (SELECT COUNT(id) FROM comments WHERE song_id = s.id) as 'com'
                FROM
                    songs s
                LEFT JOIN
                    votes v ON (s.id = v.song_id)
                WHERE
                    s.category_id = ? AND s.deleted_at IS NULL
                GROUP BY
                    s.id
                ORDER BY
                    pos DESC, neg ASC, com DESC", [$this->id]);

        $data = new \Illuminate\Database\Eloquent\Collection;

        foreach($records as $record) {
            $song = \Ss\Repositories\Song\Song::find($record->id);

            $data->add($song);
        }

        return $data;
    }
}