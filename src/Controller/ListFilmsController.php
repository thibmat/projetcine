<?php
namespace src\Controller;

use src\Utilities\Database;
use src\Entity\Film;


class ListFilmsController
{

    /**
     * Liste les différents films de la table films
     * @param int $min : Debut de la requete
     * @param int $max : Fin de la requète
     * @return array
     */
    public function listFilms(?int $min=0,?int $max=6){

        //Connexion à la BDD
        $database = new Database();

        //Requete SQL
        $query = "SELECT * FROM film ORDER BY film_titre,film_date LIMIT ".$min.",".$max."";
        $films = $database->query($query,Film::class);
        return compact('films');
    }
}



