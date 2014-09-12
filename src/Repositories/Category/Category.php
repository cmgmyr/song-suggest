<?php
namespace Ss\Repositories\Category;

use Ss\Models\BaseModel;

class Category extends BaseModel
{
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