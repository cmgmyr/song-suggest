<?php
namespace Ss\Repositories\Activity;

use Illuminate\Database\Eloquent\Model;

class EloquentActivity implements ActivityInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $activity;

    function __construct(Model $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Accept new activity data that will be persisted in data source
     *
     * @param Activity $activity
     * @return \Ss\Repositories\Activity\Activity
     * @throws ActivityNotSavedException
     */
    public function save(Activity $activity)
    {
        $activity->save();

        if (!$activity->id) {
            throw new ActivityNotSavedException('The activity was not saved.');
        }

        return $activity;
    }
} 