<?php
namespace Ss\Domain\User;

use Ss\Repositories\User\User;

class UpdateUserCommand
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var
     */
    public $input;

    public function __construct(User $user, $input)
    {
        $this->user = $user;
        $this->input = $input;
    }
}
