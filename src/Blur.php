<?php

namespace Src;

use Src\Effect as Effect;

class Blur extends Effect
{
    protected static $params = [];

    public static function apply($path, $saveName)
    {
        if (is_array($path) && !empty($path)) {
            $filenameList = [];
            foreach ($path as $key => $url) {
                $filenameList[] = self::applyOne($url, $saveName . $key);
            }
            return $filenameList;
        } else {
            return self::applyOne($path, $saveName);
        }

    }

    protected static function applyOne($url, $saveName)
    {
        $image = imagecreatefromjpeg($url);
        for ($i = 0; $i < 10; $i++) {
            imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
        }

        imagefilter($image, IMG_FILTER_SMOOTH, 0);

        //var_dump($dst);
        $filename = 'img/' . $saveName . '.jpg';
        imagejpeg($image, $filename);
        return $filename;
    }
}