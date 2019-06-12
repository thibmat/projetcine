<?php

namespace src\Entity;


use src\Utilities\Database;

class Genre
{

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
    public function getGenreId(): int
    {
        return $this->genre_id;
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

    public function recupGenre():array
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM genre";
        $genre = $database->query($query, Genre::class);
        return $genre;
    }

}