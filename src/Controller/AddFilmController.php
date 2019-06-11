<?php

namespace src\Controller;
use src\Entity\Film;
use src\Utilities\Database;
use src\Utilities\FormValidator;

class AddFilmController
{
    public function verifAddFilm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errorMessageTitre = FormValidator::checkPostText('film_titre', 128);
            $errorMessageDate = FormValidator::checkPostDate('film_date');
            $errorMessageSinopsys = FormValidator::checkPostText('film_sinopsys', 65000);
           // Todo: $errorMessageImage verification des champs de type file
            if (empty($errorMessageTitre) && empty($errorMessageDate) && empty($errorMessagesinopsys)){
                // Il n'y a pas d'erreur, on passe à l'inscription
                $database = new Database();
                $database->connect();
                // On crée un utilisateur en local
                $film = new Film();
                $film->setFilmTitre($_POST['film_titre']);
                $film->setFilmDate($_POST['film_date']);
                $film->setFilmSinopsys($_POST['film_sinopsys']);
                $film->setGenreId($_POST['genre_id']);
                $film->setFilmImageName('/films/'.$_POST['film_image_name']);
                if(isset($_POST['update']) && $_POST['update'] != 0 ){
                    $query = "UPDATE film SET film_titre =".$database->getStrParamsGlobalSQL($film->getFilmTitre()).", film_date = ".$database->getStrParamsGlobalSQL($film->getFilmDate()).", film_sinopsys = ".$database->getStrParamsGlobalSQL($film->getFilmSinopsys()).",genre_id = ".$database->getStrParamsGlobalSQL($film->getGenreId()).",film_image_name = ".$database->getStrParamsGlobalSQL($film->getFilmImageName())." WHERE film_id = '".$_POST['update']."'";
                } else {
                $query = "INSERT INTO film (film_titre, film_date, film_sinopsys, genre_id, film_image_name) VALUES (".$database->getStrParamsGlobalSQL($film->getFilmTitre(),$film->getFilmDate(),$film->getFilmSinopsys(),$film->getGenreId(), $film->getFilmImageName()).")";
                }
                try{
                    $success = $database->exec($query);
                }catch(\PDOException $e){
                        throw new \Exception('PDOException dans AddFilmController');
                }
            }
        }
        return compact ('success','errorMessageTitre','errorMessageDate','errorMessageSinopsys','film');
    }




}