<?php


namespace src\Entity;

use src\Utilities\Database;
use \DateTime;

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
     * @var DateTime
     */
    private $critique_date;

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
        return $this->critique_titre ?? '';
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
        return $this->critique_contenu ?? '';
    }

    /**
     * @param string $critique_description
     */
    public function setCritiqueContenu(string $critique_contenu): void
    {
        $this->critique_contenu = $critique_contenu;
    }

    /**
     * @return DateTime
     */
    public function getCritiqueDate(): DateTime
    {
        if (is_string($this->critique_date)){
            $this->critique_date = new DateTime($this->critique_date);
        }
        return $this->critique_date ?? '';
    }

    /**
     * @param DateTime $critique_date
     */
    public function setCritiqueDate(DateTime $critique_date): void
    {
        $this->critique_date = $critique_date;
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
        $query = "SELECT critique_titre,critique_contenu,critique_date, user_name FROM critique NATURAL JOIN app_user WHERE isPublished = 1 AND film_id = '" .$film_id."' ORDER BY critique_id";
        $critiques = $database->query($query,Critique::class);
        return compact('critiques');
    }

    /**
     * Cette fonction permet de récupérer les details d'une critique en bdd
     * @param int $critiqueId
     * @param string $className
     * @return Critique
     */
    public function detailCritique(int $critiqueId, string $className):Critique
    {
        //Connexion à la BDD
        $database = new Database();
        //Requete SQL
        $query = "SELECT * FROM critique WHERE critique_id = '" . $critiqueId . "'";
        $critique = $database->queryUnique($query, $className);
        return $critique;
    }




}