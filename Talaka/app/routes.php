<?php
header('Content-Type: text/html; charset=utf-8');

//====================== ROUTES ========================================
//General
$app->get("/", "Pagecon:index");
$app->get("/explore", "Pagecon:explorar");
//Visitor
$app->get("/signin", "Pagecon:signin");
$app->get("/signup", "Pagecon:signup");

//Error
$app->get("/error/{msg:(.*)}", "Pagecon:error");

//API
$app->post("/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}/{arg0:[A-Za-z0-9!@#$%^&*\s]+}/{arg1:[0-9]+}", function($req, $res){
    var_dump($req->getParams());
});
