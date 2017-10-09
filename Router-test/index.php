<?php
ini_set('xdebug.var_display_max_depth', 9);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

include "Request.php";
include "Router.php";
$app = new Router();

$app->get("/",function(Request $request,$response){
    echo "Base";
});

$app->get("/user/{id:[0-9]+}/profile/{test:[a-z]+}/update", function(Request $request, $response){
    echo "Index";
});

$app->get("/user/{id:[0-9]+}", function(Request $request, $response){
    echo "Index";
});


$app->run();