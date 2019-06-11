<?php


namespace src\Entity;


use src\Utilities\Database;

class Critique
{
    /**
     * @var int
     */
    private $critique_id;
    /**
     * @var string
     */
    private $critique_titre;
    /**
     * @var string
     */
    private $critique_contenu;

    /**
     * @return int
     */
    public function getCritiqueId(): int
    {
        return $this->critique_id;
    }

    /**
     * @param int $critique_id
     */
    public function setCritiqueId(int $critique_id): void
    {
        $this->critique_id = $critique_id;
    }

    /**
     * @return string
     */
    public function getCritiqueTitre(): string
    {
        return $this->critique_titre;
    }

    /**
     * @param string $critique_titre
     */
    public function setCritiqueTitre(string $critique_titre): void
    {
        $this->critique_titre = $critique_titre;
    }

    /**
     * @return string
     */
    public function getCritiqueContenu(): string
    {
        return $this->critique_contenu;
    }

    /**
     * @param string $critique_description
     */
    public function setCritiqueContenu(string $critique_contenu): void
    {
        $this->critique_contenu = $critique_contenu;
    }

    /**
     * Liste les différentes critiques de la table critique
     * @param int $film_id
     * @return array|null
     */
    public function listCritiques(int $film_id):?array
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT critique_titre,critique_contenu,user_name FROM critique JOIN app_user ON app_user_user_id = app_user.user_id WHERE film_film_id = '".$film_id."' ORDER BY critique_id";
        $critiques = $database->query($query,Critique::class);
        return compact('critiques');
    }

}