<?php

namespace Ss\Repositories\Category;

use Illuminate\Database\Eloquent\Model;

class EloquentCategory implements CategoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $category;

    public function __construct(Model $category)
    {
        $this->category = $category;
    }

    /**
     * Fetches all songs from data source.
     *
     * @return object
     */
    public function all()
    {
        return $this->category->orderBy('sort', 'ASC')->get();
    }
}
