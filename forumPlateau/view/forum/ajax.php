<?php

const HTTP_OK = 200;
const BAD_REQUEST =400;
const HTTP_NOT_OK = 405;

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($SERVER['HTTP_X_REQUESTED_WITH'])=='XMLHTTPREQUEST'){
    $response=[
        "response-code" =>  BAD_REQUEST,
        "message" => "il manque le para action",
    ];
}
else{
    $response=[
        "response-code" =>  HTTP_NOT_OK,
        "message" => "method not allowed",
    ];
    echo json_encode($response);
}