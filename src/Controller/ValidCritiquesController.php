<?php
namespace src\Controller;

use src\Entity\Film;
use src\Utilities\Database;

class ValidCritiquesController {
    public function listValidCritiqueFilms():array
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM film NATURAL JOIN critique WHERE isPublished IS NULL ORDER BY film_titre,film_date";
        $films = $database->query($query, Film::class);
        return compact('films');
    }









}