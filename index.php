<?php

error_reporting(E_ERROR | E_PARSE);

include_once 'src/Request.php';
include_once 'src/Utilities.php';
include_once 'src/Database.php';

try {
    // get request data
    $limit = Request::getFromQuery('limit', 10);
    $direction = Request::getFromQuery('direction');
    $field = Request::getFromQuery('field');

    // validate request data
    Utilities::whiteList($limit, [10, 50, 100], "Invalid limit");
    Utilities::whiteList($direction, ["ASC","DESC", "asc", "desc"], "Invalid direction");
    Utilities::whiteList($field, [1, 2, 3, 4, 5], "Invalid field");

    // fetch data
    $database = new Database();
    $offset = (Utilities::getPageNumber() - 1) * $limit;
    $rows = $database->getData($offset, $limit, $direction, (int)$field);
    $total = $database->countAllData()['total'] ?? 0;

    // display view
    include 'view.php';

} catch (\Exception $exception) {
    echo $exception->getMessage();
}