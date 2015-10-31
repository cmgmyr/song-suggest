<?php

use Ss\Repositories\User\User;

class UserModelTest extends TestCase
{
    /** @test */
    public function it_should_hash_password()
    {
        $user = new User;
        $plainPassword = 'mypassword';

        // set the password attribute
        $user->setPasswordAttribute($plainPassword);

        // plain password should not match hashed password
        $this->assertNotEquals($plainPassword, $user->password);
    }
}
