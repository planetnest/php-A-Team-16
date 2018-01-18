<?php
require('../vendor/autoload.php');
require('api.php');

if(preg_match("/[,:\"{}]+/", $_SERVER['QUERY_STRING']) ){
    $API = new API;
    $API->post();
} else {
    $API = new API;
    $API->get();
}

