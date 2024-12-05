<?php 

/*=============================================
Depurar errores
=============================================*/

ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", "D:/xampp/htdocs/ecommerce/web/php_error_log");

/*=============================================
Require
=============================================*/

require_once "controllers/template.controller.php";
require_once "controllers/curl.controller.php";
require_once 'extensions/vendor/autoload.php';

/*=============================================
Plantilla
=============================================*/

$index = new TemplateController();
$index->index();


