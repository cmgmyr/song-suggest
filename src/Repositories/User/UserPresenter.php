<?php
namespace Ss\Repositories\User;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{

    /**
     * Gets the URL for the user's avatar image
     *
     * @param int $size
     * @return string
     */
    public function avatar($size = 30)
    {
        if ($this->image != null) {
            // @todo: handle uploaded user image
        } else {
            return $this->gravatar($size);
        }
    }

    protected function gravatar($size)
    {
        $email = md5($this->email);

        return "//www.gravatar.com/avatar/{$email}?s={$size}";
    }

}