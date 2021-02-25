<?php

namespace App\Services;


use Illuminate\Support\Facades\Cache;

trait SystemCache
{
    /**
     * @param $key
     */
    public static function forget($key)
    {
        Cache::forget($key);
    }

    /**
     * Clear cache tag by type
     * @param $type
     * @param $position
     */
    public static function clearTag(int $type, int $position)
    {
        if ($type === 2) {
            Cache::forget(\Constant::CACHE_ALL_TAG_ENTERPRISE);
        }

        if ($type === 1 && $position === 1) {
            Cache::forget(\Constant::CACHE_ALL_TAG_POPULAR);
        }

        if ($type === 1 && $position === 2) {
            Cache::forget(\Constant::CACHE_ALL_TAG_CM_POPULAR);
        }
    }

    /**
     * Clear session hat slug
     */
    public function clearHatSlug()
    {
        session()->put('hat_slug', null);
    }
}
