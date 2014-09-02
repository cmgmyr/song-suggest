<?php
namespace Ss\Domain\User;

use Ss\Repositories\User\User;

class UpdateUserCommand
{

    /**
     * @var \Ss\Repositories\User\User
     */
    public $user;

    public $input;

    function __construct(User $user, $input)
    {
        $this->user = $user;
        $this->input = $input;
    }
} 