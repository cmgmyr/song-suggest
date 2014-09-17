<?php
namespace Ss\Domain\User;

use Ss\Repositories\User\User;

class RestoreUserCommand
{
    public $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }
} 