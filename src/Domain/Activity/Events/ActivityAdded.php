<?php
namespace Ss\Domain\Activity\Events;

use Ss\Repositories\Activity\Activity;

class ActivityAdded
{
    /**
     * @var Activity
     */
    public $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }
}
