<?php
use App\Autoloader;
use App\Core\Main;

// on definie une constante contenant le dossier racine du projet
define ("ROOT", dirname(__DIR__));
define("URL", "/projectsIndex/practicePHP_OOP_MVC/public/");

// on import l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

// on instance Main rooter
$app = new Main;

// on demarre l'appplication
$app->start();






