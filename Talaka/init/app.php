<?php
define("base_url", "/Talaka/");
define("BASE", $_SERVER["DOCUMENT_ROOT"] . "/Talaka/");

ini_set('xdebug.var_display_max_depth', 9);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

session_start();
// set your locale
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
require __DIR__ . '/../../vendor/autoload.php';

$app = new \Talaka\Models\Router\Router();

require __DIR__ . '/../app/routes.php';