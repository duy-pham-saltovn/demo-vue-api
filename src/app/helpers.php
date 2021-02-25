<?php

if (!function_exists('makeImgURL')) {
    /**
     * Make IMAGE URL
     * @param $url
     * @return string
     */
    function makeImgURL($url)
    {
        if (empty($url)) {
            return asset('images/not-found.jpg');
        }

        return config('app.cdn_url') . $url;
    }
}

