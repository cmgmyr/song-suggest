<?php
namespace Ss\Domain\Activity;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\Activity\Activity;
use Ss\Repositories\Activity\ActivityInterface;

class CreateActivityCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var ActivityInterface
     */
    protected $activity;

    function __construct(ActivityInterface $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $activity = Activity::add($command->song_id, $command->user_id, $command->message, $command->color_class);

        $this->activity->save($activity);

        $this->dispatchEventsFor($activity);

        return $activity;
    }
}