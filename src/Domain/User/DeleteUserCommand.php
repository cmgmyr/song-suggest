<?php

namespace Ss\Domain\User;

use Ss\Repositories\User\User;

class DeleteUserCommand
{
    /**
     * @var \Ss\Repositories\User\User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
