<?php
namespace src\Entity;

class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $user_role;



    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->setPassword($password);
    }
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password):void
    {
        $this->password = password_hash($password,PASSWORD_DEFAULT);
    }

    /**récupère le nom d'utilisateur, l'amil et le mot de passe. Prepare la requete SQL pour le "Insert into"
     * @return string
     */

    public function getStrParamsSQL():string
    {
        $tab = [$this->username, $this->email, $this->password];
        return "'".htmlentities(implode("','",$tab))."'";

    }

    /**
     * @return int
     */
    public function getUserRole()
    {
        return $this->user_role;
    }
}
