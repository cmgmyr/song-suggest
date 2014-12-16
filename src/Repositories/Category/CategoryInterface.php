<?php
namespace Ss\Repositories\Category;

interface CategoryInterface
{
    /**
     * Fetches all categories from data source
     *
     * @return object
     */
    public function all();
}
