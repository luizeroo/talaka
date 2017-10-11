<?php
session_start();
//Classes a serem implementadas
include_once("../Model/Connection.php");
include_once("../Model/System.php");
include_once("../Model/Project.php");
include_once("../Controller/class/User.php");
include_once("../Controller/class/Client.php");
include_once("../Controller/class/Visitor.php");
include_once("../Controller/Pagecon.php");

//Criando o objeto da classe para execução
$class = ucfirst($_GET['class']);
$obj = new $class($class);
$met = $_GET['met'];
$arg0 = $_GET['arg0'];
$arg1 = $_GET['arg1'];
$httpM = $_SERVER['REQUEST_METHOD'];
$method = ($class === "Pagecon" )? $met : $met.$httpM;

//Exemplos de curl
//Insere User
//curl -v -X POST "http://talaka-beta-gmastersupreme.c9users.io/exec/visitor/user" -H "Content-Type: application/json"  -d '{"nm_user":"Mikasa Ackerman","ds_login":"mikasa@gmail.com","ds_pwd":"1234","ds_path_img":"mikasa.jpg","dt_birth":"1999-03-11"}'

//Altera Info User
//curl -v -X PUT "https://talaka-beta-gmastersupreme.c9users.io/exec/client/profile/1" -H "Content-Type: application/json" -d '{"nm_user":"Eren Jeager"}'

//Pesq Project
//curl -v -X GET "http://talaka-beta-gmastersupreme.c9users.io/exec/client/pesqName/o/1"

//Insere Project
//curl -v -X POST "http://talaka-beta-gmastersupreme.c9users.io/exec/client/project/23" -H "Content-Type: application/json"  -d '{"nm_title":"Mônica - Graphic Novel","ds_project":"Mônica, Cebolinha, Magali e Cascão cometem um erro grave na escola. Agora, terão que encarar as consequências. E elas não serão poucas! Depois do sucesso de Laços, os irmãos Vitor e Lu Cafaggi retornam aos clássicos personagens de Mauricio de Sousa em Lições, mostrando o real valor da palavra amizade nesta Turma.", "ds_resume":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum blandit tortor arcu, non hendrerit eros iaculis sed. In ornare mollis augue ac tristique. Aliquam malesuada nibh venenatis dolor suscipit, in maximus orci placerat. Donec ullamcorper, quam eget laoreet mollis, lectus eros maximus dui, eget interdum arcu leo id urna. Vivamus ornare ligula et odio interdum imperdiet. Cras et erat non orci tincidunt interdum. Nam facilisis purus vitae nisl tempus tempor. Nam sit amet nibh nec ligula finibus sollicitudin. Integer egestas eleifend imperdiet. Sed auctor erat at ante commodo, sed vestibulum velit facilisis. Cras rutrum lorem at metus aliquet, aliquet fringilla elit tincidunt. Phasellus eu justo elementum quam vestibulum sodales a non lorem. Suspendisse pretium ullamcorper posuere. Nulla ac turpis metus. Nulla quam libero, tempus nec consequat a, posuere nec eros. Nunc vel dui vel dolor malesuada tincidunt eget eget odio. Morbi sollicitudin efficitur turpis id consectetur. Aliquam in libero at lorem aliquam sagittis ut et sem. Donec placerat consectetur tincidunt. Vestibulum ut metus odio. Vivamus auctor tortor quis lacus scelerisque blandit. Nunc iaculis rutrum convallis. Sed bibendum non velit id viverra. Suspendisse nunc lorem, maximus vitae augue nec, sagittis aliquam ex. Sed quis erat augue. Quisque pulvinar id nunc eu mattis. Fusce maximus elit ipsum, ut mollis nisi lacinia sed. Aliquam ornare massa vel ligula tempor pharetra. Nulla aliquet mi nisi, ac hendrerit nibh tincidunt elementum. Etiam cursus nisi scelerisque, iaculis enim sit amet, bibendum purus. In in tincidunt mauris. Aenean sit amet orci eget metus imperdiet sagittis. Morbi dictum in sapien ut rutrum. Curabitur aliquet id odio vel sagittis." ,"vl_meta":1000.00,"dt_final":"2017-10-12","cd_category":"4","ds_path_img":"monica.jpg","ds_img_back":"Capa_Monica.png"}'

//Ver Projeto
//curl -v -X GET "http://talaka-beta-gmastersupreme.c9users.io/exec/visitor/project/4"

//Financiar Project
//curl -v -X POST "http://talaka-beta-gmastersupreme.c9users.io/exec/client/invest/1" -H "Content-Type: application/json" -d '{"cd_project":2,"vl_financing":16.00}'

//Lista Project
//curl -v -X GET "http://talaka-beta-gmastersupreme.c9users.io/exec/visitor/pesqOld/4"

//Lista Proj Cat
//curl -v -X GET "http://talaka-beta-gmastersupreme.c9users.io/exec/visitor/cat/1/1"

//Pega info user
//curl -v -X GET "http://talaka-beta-gmastersupreme.c9users.io/exec/visitor/profile/23"

//Login User
//curl -v -X POST "http://talaka-beta-gmastersupreme.c9users.io/exec/client/auth" -H "Content-Type: application/json"  -d '{"login":"caroles","pwd":"12345"}'

//Lista New Project
//curl -v -X GET "http://talaka-beta-gmastersupreme.c9users.io/exec/visitor/pesqNew/6"

//Inserir Comentario
//curl -v -X POST "http://talaka-beta-gmastersupreme.c9users.io/exec/client/comments/7" -H "Content-Type: applicati -/json" -d '{"cd_project":19,"ds_comment":"alooooo"}'
$resp = (isset($arg0))? ( (isset($arg1))? json_decode($obj->$method($arg0,$arg1) )  : json_decode($obj->$method($arg0)) ) : json_decode($obj->$method());
/*
Para o Listar
$ob = json_decode($resp->data);
echo $ob->d1->login . "\n";
*/
echo ($class === "Pagecon" )? ""  : json_encode($resp);
?>