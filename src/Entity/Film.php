<?php


namespace src\Entity;


use src\Utilities\Database;

class Film
{
    /**
     * @var int
     */
    private $film_id;
    /**
     * @var string
     */
    private $film_titre;
    /**
     * @var string
     */
    private $film_date;
    /**
     * @var string
     */
    private $film_synopsis;
    /**
     * @var string
     */
    private $film_image_name;


    /**
     * @return int
     */
    public function getFilmId(): int
    {
        return $this->film_id;
    }

    /**
     * @param int $film_id
     */
    public function setFilmId(int $film_id): void
    {
        $this->film_id = $film_id;
    }

    /**
     * @return string
     */
    public function getFilmTitre(): string
    {
        return $this->film_titre;
    }

    /**
     * @param string $film_titre
     */
    public function setFilmTitre(string $film_titre): void
    {
        $this->film_titre = $film_titre;
    }

    /**
     * @return string
     */
    public function getFilmDate(): string
    {
        return $this->film_date;
    }

    /**
     * @param string $film_date
     */
    public function setFilmDate(string $film_date): void
    {
        $this->film_date = $film_date;
    }

    /**
     * @return string
     */
    public function getFilmSynopsis(): string
    {
        return $this->film_synopsis;
    }

    /**
     * @param string $film_synopsis
     */
    public function setFilmSynopsis(string $film_synopsis): void
    {
        $this->film_synopsis = $film_synopsis;
    }
    /**
     * @return string
     */
    public function getFilmImageName(): string
    {
        return $this->film_image_name;
    }

    /**
     * Cette fonction permet de récupérer les details d'un film
     * @param int $film_id
     * @param string $classname
     * @return array
     */
    public function detailFilms(int $film_id)
    {

        //Connexion à la BDD
        $database = new Database();

        //Requete SQL
        $query = "SELECT * FROM film WHERE film_id = '".$film_id."'";
        $films = $database->queryUnique($query);
        return $films;
    }
}