<?php

use App\Helper\Site;

if (!function_exists('dump')) {
    function dump($var, $die = false, $all = false, $export = false)
    {
        Site::dump($var, $die, $all, $export);
    }
}
