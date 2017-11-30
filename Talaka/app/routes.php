<?php
header('Content-Type: text/html; charset=utf-8');

//====================== ROUTES ========================================
//General
$app->get("/", "PageController:index");
$app->get("/explore", "PageController:explorar");
$app->get("/explore/{termo:(.*)}/{page:[0-9]+}","PageController:explore");
$app->get("/campanha/{title:(.*)}", "PageController:project");

//User
$app->get("/signout", "PageController:logout");
$app->get("/perfil/{username:(.*)}", "PageController:profile");
$app->get("/cadastrar-campanha","PageController:cadastrarcampanha");


//Visitor
$app->get("/signin", "PageController:signin");
$app->get("/signup", "PageController:signup");
$app->get("/criar-campanha", "PageController:criarcampanha");

//Admin
$app->get("/talaka/admin", "PageController:admin");
$app->get("/talaka/admin/dash", "PageController:dashboard");

//Error
$app->get("/error/{msg:(.*)}", "PageController:error");

//API
$app->post("/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}", "ApiController:exec");
$app->post("/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}/{arg0:[A-Za-z0-9!@#$%^&*\s]+}", "ApiController:exec");
$app->map(["GET","POST"],"/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}/{arg0:[A-Za-z0-9!@#$%^&*\s]+}/{arg1:[0-9]+}", "ApiController:exec");


//Testes
$app->get("/teste/select", "PageController:teste");