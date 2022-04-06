<?php

class Request
{
    static public function getFromQuery($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }
}