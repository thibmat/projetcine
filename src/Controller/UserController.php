<?php


namespace src\Controller;
use src\Entity\User;
use src\Utilities\Database;

class UserController
{
    /**
     * Cette fonction récupère l'id de l'user dans l'URL
     * @return int
     */
    public function recupUserId():int
    {
        $url = $_SERVER['REQUEST_URI'];
        $userId = substr($url, 8);
        return $userId;
    }

    /**
     * Liste les différents films de la table films
     * @param int $min : Debut de la requete
     * @param int $max : Fin de la requète
     * @return array
     */
    public function recupUserDetails()
    {
        //Connexion à la BDD
        $database = new Database();
        $userId = $this->recupUserId();
        //Requete SQL
        $query = "SELECT * FROM app_user WHERE user_id = '".$userId."'";
        $user = $database->queryUnique($query,User::class);
        return $user;
    }

}