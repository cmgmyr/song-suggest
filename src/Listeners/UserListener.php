<?php
namespace Ss\Listeners;

use Laracasts\Commander\Events\EventListener;
use Ss\Domain\User\Events\UserAdded;
use Ss\Domain\User\Events\UserDeleted;
use Ss\Domain\User\Events\UserRestored;
use Ss\Domain\User\Events\UserUpdated;
use Ss\Repositories\Setting\SettingInterface;
use Ss\Repositories\User\UserInterface;

class UserListener extends EventListener
{
    /**
     * @var SettingInterface
     */
    protected $setting;

    /**
     * @var UserInterface
     */
    protected $user;

    public function __construct(SettingInterface $setting, UserInterface $user)
    {
        $this->setting = $setting;
        $this->user = $user;
    }

    /**
     * Updates the voting threshold when a user was added
     *
     * @param UserAdded $event
     */
    public function whenUserAdded(UserAdded $event)
    {
        $this->updateThreshold();
    }

    /**
     * Updates the voting threshold when a user was deleted
     *
     * @param UserDeleted $event
     */
    public function whenUserDeleted(UserDeleted $event)
    {
        $this->updateThreshold();
    }

    /**
     * Updates the voting threshold when a user was restored
     *
     * @param UserRestored $event
     */
    public function whenUserRestored(UserRestored $event)
    {
        $this->updateThreshold();
    }

    /**
     * Updates the voting threshold when a user was updated
     *
     * @param UserUpdated $event
     */
    public function whenUserUpdated(UserUpdated $event)
    {
        $this->updateThreshold();
    }

    /**
     * Updates the voting threshold when a user action took place
     */
    protected function updateThreshold()
    {
        $userCount = $this->user->countAll();
        $this->setting->updateThreshold($userCount);
    }
}
