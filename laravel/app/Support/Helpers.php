<?php

if (!function_exists('pr')) {
    /**
     * @param $data
     * @param bool $exit
     */
    function pr($data, $exit = true)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";

        if ($exit) exit();
    }
}
