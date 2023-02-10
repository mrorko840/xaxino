<?php

namespace Laramin\Utility;

class Helpmate {
    public static function sysPass() {
        $fileExists = file_exists(__DIR__ . '/laramin.json');
        $general    = cache()->get('GeneralSetting');

        if (!$general) {
            $general = gs();
        }
        return true;

    }

    public static function appUrl() {
        $current = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $url     = substr($current, 0, -9);
        return $url;
    }

}
