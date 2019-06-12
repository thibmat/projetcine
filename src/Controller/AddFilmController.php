<?php

namespace src\Controller;
use src\Entity\Film;
use src\Entity\Genre;
use src\Utilities\Database;
use src\Utilities\FormValidator;

class AddFilmController
{
    public function verifAddFilm()
    {
        $formValidator = new FormValidator();
        $errors = [];
        $genre = new Genre();
        $genres = $genre->recupGenre();
        $filmId = $this->addrecupId();
        $filmId=intval($filmId['id']);
        $film = new film();
        if (isset($filmId) && $filmId != 0) {
            $film = $film->detailFilms($filmId,Film::class);
            $valider = "Mettre à jour le film";
            $update = $film->getFilmId();
        }
        else {
            $valider = "Ajouter le film";
            $update = 0;
        }
        $titre = $_POST['film_titre'] ?? $film->getFilmTitre();
        $date = $_POST['film_date'] ?? $film->getFilmDate();
        $sinopsys = $_POST['film_sinopsys'] ?? $film->getFilmSinopsys();
        $genreFilm = $_POST['genre_id'] ?? $film->getGenreId() ?? '';
        $imageName = $_POST['film_image_name'] ?? $film->getFilmImageName();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $formValidator->validate([
                ['film_titre', 'text', 128],
                ['film_date','date'],
                ['film_sinopsys', 'text', 65000],
                ['film_image_name','file',2,'films', ['jpg'=>'image/jpeg']]
            ]);

            $update = intval($_POST['update']);

           // Todo: $errorMessageImage verification des champs de type file
            $isError = false;
            foreach ($errors as $error) {
                if($error !== '') {
                    $isError = true;
                }
            }
            if (!$isError) {
                // Il n'y a pas d'erreur, on passe à l'inscription
                $database = new Database();
                $database->connect();
                // On crée un film en local
                $film = new Film();
                $film->setFilmTitre($titre);
                $film->setFilmDate($date);
                $film->setFilmSinopsys($sinopsys);
                $film->setGenreId($genreFilm);
                $film->setFilmImageName('/films/'.$_FILES['film_image_name']["name"]);
                if($update != 0){
                    $query = "UPDATE film SET film_titre =".$database->getStrParamsGlobalSQL($titre).", film_date = ".$database->getStrParamsGlobalSQL($date).", film_sinopsys = ".$database->getStrParamsGlobalSQL($sinopsys).",genre_id = ".$database->getStrParamsGlobalSQL($genreFilm).",film_image_name = ".$database->getStrParamsGlobalSQL($film->getFilmImageName())." WHERE film_id = '".$update."'";
                } else {
                $query = "INSERT INTO film (film_titre, film_date, film_sinopsys, genre_id, film_image_name) VALUES (".$database->getStrParamsGlobalSQL($titre,$date,$sinopsys,$genreFilm, $film->getFilmImageName()).")";
                }
                try{
                    $success = $database->exec($query);
                }catch(\PDOException $e){
                        throw new \Exception('PDOException dans AddFilmController');
                }
            }
        }
        return compact ('success','errors','errorMessageTitre','errorMessageDate','errorMessageSinopsys','film','genres','formValidator', 'titre', 'date', 'sinopsys', 'imageName', 'genreFilm','valider','update');
    }
    public function addrecupId()
    {
        $url = $_SERVER['REQUEST_URI'];
        $id = substr($url, 9);
        return compact('id');
    }
}