<?php


namespace src\Controller;

use src\Entity\Genre;
use src\Utilities\Database;
use src\Utilities\FormValidator;

class AddGenreController
{
    public function recupGenres()
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM genre ORDER BY genre_libelle";
        $genres = $database->query($query,Genre::class);
        return $genres;
    }

    public function addGenre(?int $genreId = 0):array
    {
        $formValidator = new FormValidator();
        $errors = [];
        $success = 0;
        $genre = new Genre();
        $datas = $this->addrecupGenreId();
        extract($datas);
        $genreId=intval($genreId);
        $valider = "Ajouter le genre";
        if (isset($genreId) && $genreId != 0) {
            $genre = $this->detailGenre($genreId,Genre::class);
            $valider = "Mettre à jour le Genre";
            $update = true;
        }else{
            $valider = "Insérer le genre";
        }
        $genre_libelle = $_POST['genre_libelle'] ?? $genre->getGenreLibelle() ?? '';
                //Verification formulaire + inscription de l'utilisateur en bdd
        if (isset($action) && $action === 'delete'){
            $database = new Database();
            $query = "DELETE FROM genre WHERE genre_id ='".$genreId."'";
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = $formValidator->validate([
                ['genre_libelle', 'text', 150]
            ]);
            $isError = false;
            foreach ($errors as $error) {
                if($error !== '') {
                    $isError = true;
                }
            }
            if (!$isError) {
                //var_dump("On peut creer la critique");
                $database = new Database();
                // On crée un genre en local
                $genre->setGenreLibelle($_POST['genre_libelle']);
                if (!$update) {
                    $query = "INSERT INTO genre (genre_libelle) VALUES (" . $database->getStrParamsGlobalSQL($genre->getGenreLibelle()) . ")";
                }else{
                    $query = "UPDATE genre SET genre_libelle = ".$database->getStrParamsGlobalSQL($genre->getGenreLibelle()) . " WHERE genre_id = '".$genreId."'";
                }
                    try{
                        $success = $database->exec($query);
                    }catch(\PDOException $e){
                        throw new \Exception('PDOException dans registerController');
                    }

            }
        }
        return compact('errors', 'success', 'genre', 'formValidator', 'genre_libelle', 'valider');
    }
    public function addrecupGenreId():array
    {
        $url = $_SERVER['REQUEST_URI'];
        $ids = explode('/',substr($url, 10));
        $genreId = $ids[0];
        if (isset($ids[1])) {
            $action = $ids[1];
        }
        $genreId = intval($genreId);
        return compact('genreId','action');
    }
    public function detailGenre(int $genreId, string $className):Genre
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM genre WHERE genre_id = '" . $genreId . "'";
        $genres = $database->queryUnique($query, $className);
        return $genres;
    }


}