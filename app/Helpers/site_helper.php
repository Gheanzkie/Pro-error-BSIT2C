<?php

if (!function_exists('siteTitle')) {
    function siteTitle($page = '') {
        $base = 'Hisona Store';
        return $page ? $base . ' | ' . $page : $base;
    }
}