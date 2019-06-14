<?php

namespace src\Entity;

use DateTime;
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
     * @var DateTime
     */
    private $film_date;
    /**
     * @var string
     */
    private $film_sinopsys;
    /**
     * @var string
     */
    private $film_image_name;

    /**
     * @var int
     */
    private $genre_id;

    /**
     * @var string
     */
    private $genre_libelle;

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
        return $this->film_titre  ?? '';
    }

    /**
     * @param string $film_titre
     */
    public function setFilmTitre(string $film_titre): void
    {
        $this->film_titre = $film_titre;
    }

    /**
     * @return DateTime
     * @throws \Exception
     */
    public function getFilmDate(): DateTime
    {
        if (is_string($this->film_date)){
            $this->film_date = new DateTime($this->film_date);
        }
        return $this->film_date ?? new DateTime();
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
    public function getFilmSinopsys(): string
    {
        return $this->film_sinopsys  ?? '';
    }

    /**
     * @param string $film_sinopsys
     */
    public function setFilmSinopsys(string $film_sinopsys): void
    {
        $this->film_sinopsys = $film_sinopsys;
    }

    /**
     * @return string
     */
    public function getFilmImageName(): string
    {
        return $this->film_image_name  ?? '';
    }

    /**
     * @param string $film_image_name
     */
    public function setFilmImageName(string $film_image_name): void
    {
        $this->film_image_name = $film_image_name;
    }

    /**
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genre_id  ?? 0;
    }

    /**
     * @param int $genre_id
     */
    public function setGenreId(int $genre_id): void
    {
        $this->genre_id = $genre_id;
    }

    /**
     * @return string
     */
    public function getGenreLibelle(): string
    {
        return $this->genre_libelle;
    }

    /**
     * @param string $genre_libelle
     */
    public function setGenreLibelle(string $genre_libelle): void
    {
        $this->genre_libelle = $genre_libelle;
    }


    /**
     * Cette fonction permet de récupérer les details d'un film
     * @param int $filmId
     * @param string $className
     * @return array
     */
    public function detailFilms(int $filmId, string $className):Film
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM film NATURAL JOIN genre WHERE film_id = '" . $filmId . "'";
        $film = $database->queryUnique($query, $className);
        return $film;
    }

    public function truncate(string $string, int $length, string $append): string
    {
        $string = trim($string);

        if (strlen($string) > $length) {
            $string = wordwrap($string, $length);
            $string = explode("\n", $string, 2);
            $string = $string[0] . $append;
        }

        return $string;
    }

    public function recupId():array
    {
        $url = $_SERVER['REQUEST_URI'];
        $request = explode('/',substr($url, 6));
        $id = $request[0];
        $action = $request[1] ?? '';
        return compact('id','action');
    }

    public function deleteFilm (int $film_id):int
    {
        $database = new Database();
        $query = "DELETE FROM film WHERE film_id = '" . $film_id . "'";
        $delete= $database->exec($query);
        return $delete;
    }
}