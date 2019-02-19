<?php

namespace Src;

use Src\Effect as Effect;

class GrayScale extends Effect
{
    protected static $params = [];

    public static function apply($path, $saveName)
    {
        if (is_array($path) && !empty($path)) {
            $filenameList = [];
            foreach ($path as $key => $url) {
                $filenameList[] = self::applyOne($url, $saveName.$key);
            }
            return $filenameList;
        }
        else {
            return self::applyOne($path, $saveName);
        }


    }

    public static function applyOne($url, $saveName)
    {
        $image = imagecreatefromjpeg($url);
        imagefilter($image, IMG_FILTER_GRAYSCALE);

        //var_dump($dst);
        $filename = 'img/' . $saveName . '.jpg';
        imagejpeg($image, $filename);
        return $filename;
    }
}