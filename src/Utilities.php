<?php

class Utilities
{
    static public function whiteList($value, $allowed, $message) {
        if ($value === null) {
            return;
        }
        $key = array_search($value, $allowed);
        if ($key === false) {
            throw new InvalidArgumentException($message);
        }
    }

    static public function getPageNumber(): int
    {
        $page = Request::getFromQuery('page');
        if ($page
            && is_numeric($page)
            && $page > 0
        ) {
            return (int)$page;
        } else {
            return 1;
        }
    }

    static public function dd($content) {
        echo '<pre>';
        var_dump($content);
        echo '</pre>';
        exit();
    }

    /**
     * Display hidden inputs to preserve query parmeters when submitting a form
     * @param $keys array of query parameters
     */
    static public function displayQueryParametersHiddenInputs(array $keys): void
    {
        foreach($keys as $name) {
            if(!isset($_GET[$name])) {
                continue;
            }
            $value = htmlspecialchars($_GET[$name]);
            $name = htmlspecialchars($name);
            echo '<input type="hidden" name="'. $name .'" value="'. $value .'">';
        }
    }
}