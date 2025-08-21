<?php

//importer les ressources
include "./env.php";

include "./vendor/autoload.php";

//Analyse de l'URL avec parse_url() et retourne ses composants
$url = parse_url($_SERVER['REQUEST_URI']);
//test si l'url posséde une route sinon on renvoi à la racine
$path = $url['path'] ??  '/';

//importer les controllers
use App\Controller\TestController;

//instancier les controllers
$testController = new TestController();

switch (substr($path, strlen(BASE_URL))) {
    case "/":
        echo "home";
        break;
    case "/test" :
        $testController->testJson();
        break;
    case "/testpost": 
        $testController->testPostJson();
        break;
    default:
        echo "erreur";
        break;
}
