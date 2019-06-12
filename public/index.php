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
$router->addRoute('/films[a-z0-9/]*','ListFilms.php');
$router->addRoute('/film/[0-9]*', 'film.php');
$router->addRoute('/connexion','connexion.php');
$router->addRoute('/addFilm[0-9/]*','addFilm.php');
$router->addRoute('/addcritique','addCritique.php');
$router->addRoute('/validcritiques[a-z0-9/]*','validCritiques.php');
$router->addRoute('/membre[a-z0-9/]*','user.php');

$template = $router->match();
require_once dirname(__DIR__) . "/templates/inc/header.php";


if(is_null($template)) {
    throw new \Exception('Page introuvable');
} else {
    require dirname(__DIR__) . "/templates/" . $template;
}
require_once dirname(__DIR__) . '/templates/inc/footer.php'; ?>