<?php


use Ss\Repositories\Category\Category;

class CategoriesSeeder extends Seeder
{

    public function run()
    {
        // create categories
        Category::create(
            array(
                'name' => 'Pending',
                'sort'  => 1,
            )
        );
        Category::create(
            array(
                'name' => 'Approved',
                'sort'  => 2,
            )
        );
        Category::create(
            array(
                'name' => 'Declined',
                'sort'  => 3,
            )
        );
        Category::create(
            array(
                'name' => 'Archived',
                'sort'  => 4,
            )
        );
        Category::create(
            array(
                'name' => 'Learning',
                'sort'  => 5,
            )
        );
        Category::create(
            array(
                'name' => 'Learned',
                'sort'  => 6,
            )
        );
    }
} 