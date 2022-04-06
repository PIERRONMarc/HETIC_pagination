<?php

class Request
{
    static public function getFromQuery($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * Append specified query parameters to specified query string
     *
     * @param array $keys keys of query parameters
     * @param string|null $queryString
     * @return string return a query string
     */
    static public function generateQueryParameters(array $keys): string
    {
        $url = '';
        foreach ($keys as $key) {
            if ($url) {
                $url .= '&';
            }
            $value = Request::getFromQuery($key);
            if ($value) {
                $url .= $key.'='.$value;
            }
        }
        return $url;
    }
}