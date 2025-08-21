<?php

//importer les ressources
include "./env.php";

include "./vendor/autoload.php";

//Analyse de l'URL avec parse_url() et retourne ses composants
$url = parse_url($_SERVER['REQUEST_URI']);
//test si l'url posséde une route sinon on renvoi à la racine
$path = $url['path'] ??  '/';


switch (substr($path, strlen(BASE_URL))) {
    case "/":
        echo "home";
        break;
    default:
        echo "erreur";
        break;
}
