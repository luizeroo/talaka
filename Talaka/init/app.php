<?php
define("base_url", "/Talaka/");
define("BASE", $_SERVER["DOCUMENT_ROOT"] . "/Talaka/");

ini_set('xdebug.var_display_max_depth', 9);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

session_start();
// set your locale
setlocale(LC_ALL, 'pt_BR');
require __DIR__ . '/../../vendor/autoload.php';

$app = new \Talaka\Models\Router\Router();

require __DIR__ . '/../app/routes.php';