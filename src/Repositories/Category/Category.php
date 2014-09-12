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
     * An category has many songs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function songs()
    {
        return $this->hasMany('Ss\Repositories\Song\Song', 'category_id')->latest();
    }
}