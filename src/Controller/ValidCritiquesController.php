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
        $query = "SELECT * FROM film NATURAL JOIN critique WHERE isPublished = '0' ORDER BY film_titre,film_date";
        $films = $database->query($query, Film::class);
        return compact('films');
    }

    /**
     * Cette fonction est appelée en backoffice pour valider une critique (Elle update le isPublished de la table critique
     * @param int $critiqueId
     * @return bool
     */
    public function validCritique(int $critiqueId):bool
    {
        $database = new Database();
        //Requete SQL
        $query = "UPDATE critique SET isPublished = '1' WHERE critique_id ='".$critiqueId."'";
        $update = $database->exec($query);
        return $update;
    }

    /**
     * Cette fonction est appelée en back pour supprimer une critique
     * @param int $critiqueId
     * @return bool
     */
    public function deleteCritique(int $critiqueId):bool
    {
        $database = new Database();
        //Requete SQL
        $query = "DELETE FROM critique WHERE critique_id ='".$critiqueId."'";
        $delete = $database->exec($query);
        return $delete;
    }

    /**
     * Cette fonction récupère dans l'URL les actions à réaliser et les réalise (edit, delete, valid)
     * @return array
     */
    public function recupAdresse()
    {
        $url = $_SERVER['REQUEST_URI'];
        $action = substr($url, 16);
        if ($action != null){
            $action = explode('/',$action);
            if($action[0] == 'valid'){
                $resultat = $this->validCritique($action[1]);
                $message = $resultat." critique validée";
            }elseif($action[0] === 'delete'){
                $resultat = $this->deleteCritique($action[1]);
                $message = $resultat." critique supprimée";
            }elseif($action[0] === 'edit'){

            }
            return compact('message');
        }
    }
}