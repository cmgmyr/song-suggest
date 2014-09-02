<?php
namespace Ss\Domain\User\Events;

use Ss\Repositories\User\User;

class UserAdded
{
    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
} 