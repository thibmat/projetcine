<?php
require dirname(__DIR__).'/autoload.php';
//Appel du routeur
use src\Utilities\Router;
session_start();

if (isset($_GET['exit'])){
    session_unset();
    $urlCourante=$_SERVER["REQUEST_URI"];
    $urlGet = explode("?",$urlCourante);
    header('Location: '.$urlGet[0]);
}



$router = new Router();
$router->addRoute('/','index.php');
$router->addRoute('/inscription','register.php');
$router->addRoute('/films','ListFilms.php');
$router->addRoute('/film','film.php');
$template = $router->match();
require_once dirname(__DIR__) . "/templates/inc/header.php";


if(is_null($template)) {
    throw new \Exception('Page introuvable');
} else {
    require dirname(__DIR__) . "/templates/" . $template;
}
require_once dirname(__DIR__) . '/templates/inc/footer.php'; ?>