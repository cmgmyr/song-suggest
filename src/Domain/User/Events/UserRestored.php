<?php
namespace Ss\Domain\User\Events;

use Ss\Repositories\User\User;

class UserRestored
{

    /**
     * @var User
     */
    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
} 