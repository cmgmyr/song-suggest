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

    function __construct(SettingInterface $setting, UserInterface $user)
    {
        $this->setting = $setting;
        $this->user = $user;
    }

    public function whenUserAdded(UserAdded $event)
    {
        $this->updateThreshold();
    }

    public function whenUserDeleted(UserDeleted $event)
    {
        $this->updateThreshold();
    }

    public function whenUserRestored(UserRestored $event)
    {
        $this->updateThreshold();
    }

    public function whenUserUpdated(UserUpdated $event)
    {
        $this->updateThreshold();
    }

    protected function updateThreshold()
    {
        $userCount = $this->user->countAll();
        $this->setting->updateThreshold($userCount);
    }
} 