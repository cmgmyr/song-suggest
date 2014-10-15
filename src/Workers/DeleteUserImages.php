<?php
namespace Ss\Workers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class DeleteUserImages
{

    public function fire($job, $data)
    {
        $directory = Config::get('uploads.location');
        $files = File::files($directory);

        foreach ($files as $file) {
            if (str_is($directory . '/' . $data['image'] . '*', $file)) {
                File::delete($file);
            }
        }

        File::delete($directory . '/' . $data['image'] . '.jpg');
    }
} 