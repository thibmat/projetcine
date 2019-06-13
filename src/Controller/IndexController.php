<?php
namespace src\Controller;

use src\Utilities\Database;
use src\Entity\Film;


class IndexController
{
    /**
     * Liste les différents produits de la table film
     */
    public function index(){

        //Connexion à la BDD
        $database = new Database();

        //Requete SQL
        $query = 'SELECT * FROM film NATURAL JOIN genre ORDER BY film_date LIMIT 0,6';
        $films = $database->query($query,Film::class);
        return compact('films');
    }
    public function sortieSemaine(){

        //Connexion à la BDD
        $database = new Database();
        $date = new \DateTime();
        $interval = new \DateInterval('P7D');
        $date = $date->sub($interval);
        $date = $date->format('Y-m-d');
        //Requete SQL
        $query = "SELECT * FROM film NATURAL JOIN genre WHERE film_date >'".$date."'";
        $filmsSemaine = $database->query($query,Film::class);
        return compact('filmsSemaine');
    }

}



