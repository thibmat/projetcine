<?php
namespace src\Utilities;

use PDO;
use src\Entity\Film;
/**
 * Cette classe utilise PDO afin d'effectuer des opérations sur la BDD
 */
class Database
{
    /**
     * Instance de PDO
     * @var PDO
     */
    private $pdo;
    public function __construct()
    {
        $this->connect();
    }
    /**
     * Creer une instance de PDO
     */
    public function connect():void
    {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=mondocine',
                'root',
                '',
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
    }
    /**
     * @param string $sql
     * @param string $className
     * @return array|null
     */
    public function query(string $sql, string $className): ?array
    {
        $result = $this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$className);
    }
    public function queryUser(string $sql, string $className): ?array
    {
            $result = $this->pdo->query($sql);
            return $result->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,$className,array('username','email','password'));
    }
    public function queryUnique(string $sql)
    {
        $result = $this->pdo->query($sql);
        return $result->fetch();
    }
    /**
     * Requete SQL pour la création, la modification, l'update et la suppression
     * @param string $sql
     * @return int
     */
    public function exec(string $sql)
    {
        return $this->pdo->exec($sql);
    }
    public function getStrParamsGlobalSQL(...$params): string
    {
        // On crée un tableau avec les 3 propriétés
        // $params = [
        //     htmlentities($this->username),
        //     htmlentities($this->email),
        //     htmlentities($this->password)
        // ];
        // On crée une chaîne de caractères séparés de virgules et les quotes simples
        $str = implode("','", $params);
        // On a ajoute une quote simple au début et une à la fin
        // On retourne l'ensemble
        return "'" . htmlentities($str) . "'" ;
    }
}