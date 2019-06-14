<?php
namespace src\Controller;

use DateTime;
use src\Entity\Genre;
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
        $query = "SELECT * FROM film NATURAL JOIN genre ORDER BY film_titre,film_date LIMIT ".$min.",".$max."";
        $films = $database->query($query,Film::class);
        return compact('films');
    }
    public function recupMinMax($min, $max):array
    {
        $url = $_SERVER['REQUEST_URI'];
        $attributs = substr($url, 7);
        $action = '';
        $delete = '';
        $films ='';
        $nbFilms = 0;
        if ($attributs != null){
            $attributs = explode('?', $attributs);
            $attr = explode('/',$attributs[0]);
            if($attr[0] === 'delete'){
                $film_id = intval($attr[1]);
                $film = new Film();
                $delete = $film->deleteFilm($film_id);
            }elseif ($attr[0] === 'filter'){
                $action='filter';
                if ($attr[1]==='genre'){
                    $genreId = $attr[2];
                    $nbFilms = $this->nbreFilmsGenre($genreId);
                    $films = $this->filterGenre($genreId, $min, $max);
                }elseif ($attr[1] === 'annee'){
                    $annee = $attr[2];
                    $nbFilms = $this->nbreFilmsAnnee($annee);
                    $films = $this->filterAnnee($annee, $min, $max);
                }
            }
        }
        return compact('delete', 'films',  'action', 'nbFilms');
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
    public function nbreFilmsGenre ($genreId):int
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT COUNT(*) FROM film WHERE genre_id ='".$genreId."'";
        $nbFilms = $database->fetch($query);
        $nbFilms = $nbFilms['COUNT(*)'];
        return $nbFilms;
    }
    public function nbreFilmsAnnee ($annee):int
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT COUNT(*) FROM film WHERE film_date BETWEEN '".$annee."-01-01' AND '".$annee."-12-31'";
        $nbFilms = $database->fetch($query);
        $nbFilms = $nbFilms['COUNT(*)'];
        return $nbFilms;
    }

    /**
     * Cette fonction récupère tous les genres présents dans la base de données
     * @return array
     */
    public function recupGenres()
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM genre";
        $genres = $database->query($query,Genre::class);
        return $genres;
    }
    public function recupAnnees():array
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT film_date FROM film";
        $annees = $database->fetchArray($query);

        foreach ($annees as $annee){
            foreach($annee as $anne) {
                $date = new DateTime($anne);
                $dates[] = $date->format('Y');
            }
        }
        return $dates;
    }
    public function filterGenre($genreId, ?int $min=0, ?int $max =6){
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM film NATURAL JOIN genre WHERE genre_id = '".$genreId."' ORDER BY film_titre,film_date LIMIT ".$min.",".$max."";

        $films = $database->query($query,Film::class);
        return $films;
    }
    public function filterAnnee($annee, ?int $min=0, ?int $max =6){
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM film NATURAL JOIN genre WHERE film_date BETWEEN '".$annee."-01-01' AND '".$annee."-12-31' ORDER BY film_titre,film_date LIMIT ".$min.",".$max."";
        $films = $database->query($query,Film::class);
        return $films;
    }
}



