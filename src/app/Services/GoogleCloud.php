<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Trait Upload
 * @package App\Services
 */
trait GoogleCloud
{
    /**
     * @param $file
     * @param $path
     * @return bool
     */
    public function uploadSingle($file, $path)
    {
        $disk = Storage::disk('gcs');
        return $disk->put($path, $file);
    }

    /**
     * @param $files
     * @param $path
     * @return array
     */
    public function uploadMultiple($files, $path)
    {
        $disk = Storage::disk('gcs');

        $results = [];

        foreach ($files as $file) {
            $results[] = $disk->put($path, $file);
        }

        return $results;
    }

    /**
     * @param $path
     * @return bool
     */
    public function delete($path)
    {
        $disk = Storage::disk('gcs');

        return $disk->delete($path);
    }
}
