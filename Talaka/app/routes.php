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
//$app->post("/cadastrar/post","PageController:cadProject");
// $app->get("/alterar","PageController: alterarusuario");
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
$app->post("/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}/{arg0:[A-Za-z0-9!@#$%^&*\s]+}", "ApiController:execZero");
$app->map(["GET","POST"],"/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}/{arg0:[A-Za-z0-9!@#$%^&*\s]+}/{arg1:[0-9]+}", "ApiController:exec");

//POSTBACK
$app->post("/pagarme/exec/postback/{user:[0-9]+}/{financing:[0-9]+}", "ApiController:postback");
//Pure Request
$app->post("/pure/exec/{class:[A-Za-z]+}/{met:[A-Za-z]+}", "ApiController:pure");
// OI GU SÓ PRA DIZER TCHAU 

//Testes
$app->get("/teste/select", "PageController:teste");