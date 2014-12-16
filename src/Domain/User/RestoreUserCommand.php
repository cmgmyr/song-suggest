<?php
namespace Ss\Domain\User;

use Ss\Repositories\User\User;

class RestoreUserCommand
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
