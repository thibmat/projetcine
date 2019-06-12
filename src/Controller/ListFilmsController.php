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
    public function listFilms(int $min,int $max):array
    {

        //Connexion à la BDD
        $database = new Database();

        //Requete SQL
        $query = "SELECT * FROM film ORDER BY film_titre,film_date LIMIT ".$min.",".$max."";
        $films = $database->query($query,Film::class);
        return compact('films');
    }
    public function recupMinMax():array
    {
        $url = $_SERVER['REQUEST_URI'];
        $minmax = substr($url, 7);
        if ($minmax != null){
            $minmax = explode('/',$minmax);
            if($minmax[0] == 'delete'){
                $film_id = intval($minmax[1]);
                $minmax = ['0','6'];
                $film = new Film();
                $delete = $film->deleteFilm($film_id);
            }
        } else {
            $minmax = ['0','6'];
        }
        return compact('minmax','delete');
    }
    public function nbreFilmsTotal ():int
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT COUNT(*) FROM film";
        $nbFilms = $database->fetch($query);
        $nbFilms = $nbFilms['COUNT(*)'];
        return $nbFilms;
    }
}



