<?php
//On inclue la classe pour pouvoir l'utiliser
//require_once 'Vehicles/Produit.php';
//On crée un autoloader pour eviter d'avoir à inclure toutes les Vehicles
//définition de l'autoloading
function myAutoloader(string $className):void
{
    $className = str_replace("\\", '/', $className);
    require $className. '.php';
}

//Enregistrement de la fonction d'autoloading
spl_autoload_register('myAutoloader');
