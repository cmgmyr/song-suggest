<?php

namespace Ss\Domain\User\Events;

use Ss\Repositories\User\User;

class UserAdded
{
    /**
     * @var User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
