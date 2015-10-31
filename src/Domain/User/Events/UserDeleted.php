<?php

namespace Ss\Domain\User\Events;

use Ss\Repositories\User\User;

class UserDeleted
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
