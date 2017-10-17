<?php
header('Content-Type: text/html; charset=utf-8');

//====================== ROUTES ========================================
//General
$app->get("/", "Pagecon:index");
$app->get("/explore", "Pagecon:explorar");
$app->get("/explore/{termo:(.*)}/{page:[0-9]+}","Pagecon:explore");
$app->get("/project/{id:[0-9]+}", "Pagecon:project");
//Visitor
$app->get("/signin", "Pagecon:signin");
$app->get("/signup", "Pagecon:signup");

//Error
$app->get("/error/{msg:(.*)}", "Pagecon:error");

//API
$app->post("/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}", "ApiController:exec");
$app->post("/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}/{arg0:[A-Za-z0-9!@#$%^&*\s]+}", "ApiController:exec");
$app->map(["GET","POST"],"/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}/{arg0:[A-Za-z0-9!@#$%^&*\s]+}/{arg1:[0-9]+}", "ApiController:exec");
