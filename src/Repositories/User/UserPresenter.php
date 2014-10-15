<?php
namespace Ss\Repositories\User;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
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
        $directory = Config::get('uploads.location');

        if ($this->image != null && File::exists($directory . '/' . $this->image . '.jpg')) {
            $this->checkAndCreateThumbnail($size);

            return '/' . $directory . '/' . $this->image . '_' . $size . '.jpg';
        } else {
            return $this->gravatar($size);
        }
    }

    /**
     * Prepares the gravatar URL
     *
     * @param $size
     * @return string
     */
    protected function gravatar($size)
    {
        $email = md5($this->email);

        return "//www.gravatar.com/avatar/{$email}?s={$size}";
    }

    /**
     * Sees if the thumbnail has already been made, or create a new one
     *
     * @param $size
     */
    protected function checkAndCreateThumbnail($size)
    {
        $thumbnailName = Config::get('uploads.location') . '/' . $this->image . '_' . $size . '.jpg';

        if (!File::exists($thumbnailName))
        {
            $image = Image::make(Config::get('uploads.location') . '/' . $this->image . '.jpg');

            $image->fit($size, $size, function ($constraint) {
                $constraint->upsize();
            });

            $image->save($thumbnailName);
        }
    }

}