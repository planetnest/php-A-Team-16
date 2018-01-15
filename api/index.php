<?php
require('../vendor/autoload.php');
require('api.php');

$API = new API;
echo 'Inside api';

//Enpoint
//GET
// key/field_searching_for/values_searching_for
//key/company/ZETHALL

//POST
//key/data_in_json
//key/[ {"_id": "5a5ac4330a4a87a85b2e69dc","index": 0,"key": "$2,670.70",}]

//PUT
//key/id/data_field_to_search_for/values_to_replace
//key/company/new_company_name

//DELETE
//key/id

// using postman simulate GET,PUT,DELETE,POST request
// key.json carries keys of api users

//https://apidevacc.herokuapp.com/ | https://git.heroku.com/apidevacc.git