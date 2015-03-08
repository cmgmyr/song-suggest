<?php
namespace Ss\Workers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class DeleteUserImages
{
    /**
     * Deletes all obsolete user images from the filesystem
     *
     * @param $job
     * @param $data
     */
    public function fire($job, $data)
    {
        $files = File::files($this->getImageDirectory());
        $image = $data['image'];

        foreach ($files as $file) {
            $this->deleteIfFound($image, $file);
        }

        File::delete($this->getImageDirectory() . '/' . $image . '.jpg');
    }

    /**
     * Returns the directory where the user images are stored
     *
     * @return mixed
     */
    private function getImageDirectory()
    {
        return Config::get('uploads.location');
    }

    /**
     * Checks to see if the image name matches the file name
     *
     * @param $image
     * @param $file
     * @return bool
     */
    private function imageFound($image, $file)
    {
        return str_is($this->getImageDirectory() . '/' . $image . '*', $file);
    }

    /**
     * Deletes a file if found
     *
     * @param $image
     * @param $file
     */
    private function deleteIfFound($image, $file)
    {
        if ($this->imageFound($image, $file)) {
            File::delete($file);
        }
    }
}
