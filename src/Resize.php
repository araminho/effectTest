<?php

namespace Src;

use Src\Effect as Effect;

class Resize extends Effect
{
    public static function apply($path, $params, $saveName)
    {
        if (is_array($path) && !empty($path)) {
            $filenameList = [];
            foreach ($path as $key => $url) {
                $filenameList[] = self::applyOne($url, $params, $saveName.$key);
            }
            return $filenameList;
        }
        else {
            return self::applyOne($path, $params, $saveName);
        }

    }

    protected static function applyOne($url, $params, $saveName)
    {
        $w = $params['width'];
        $h = $params['height'];
        list($width, $height) = getimagesize($url);
        $r = $width / $height;
        if ($w / $h > $r) {
            $newWidth = $h * $r;
            $newHeight = $h;
        } else {
            $newHeight = $w / $r;
            $newWidth = $w;
        }
        $src = imagecreatefromjpeg($url);
        $dst = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        //var_dump($dst);
        $filename = 'img/' . $saveName . '.jpg';
        imagejpeg($dst, $filename);
        return $filename;
    }
}