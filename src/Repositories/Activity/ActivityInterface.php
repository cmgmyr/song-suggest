<?php

namespace Ss\Repositories\Activity;

interface ActivityInterface
{
    /**
     * Accept new activity data that will be persisted in data source.
     *
     * @param Activity $activity
     * @return \Ss\Repositories\Activity\Activity
     * @throws ActivityNotSavedException
     */
    public function save(Activity $activity);
}
