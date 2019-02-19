<?php
namespace Src;

class Effect
{
    protected static $params = [];

    public function __construct($params = [])
    {
        foreach ($params as $key => $val) {
            self::$params[$key] = $val;
        }
    }
}