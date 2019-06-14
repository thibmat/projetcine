<?php
namespace src\Entity;
use \DateTime;

class User
{
    /**
     * @var int
     */
    private $user_id;
    /**
     * @var string
     */
    private $user_name;
    /**
     * @var string
     */
    private $user_mail;
    /**
     * @var string
     */
    private $user_password;

    /**
     * @var int
     */
    private $user_role_role_id;

    /**
     * @var string
     */
    private $user_photo;

    /**
     * @var \DateTime
     */
    private $user_dateinscription;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     */
    public function setUserName(string $user_name): void
    {
        $this->user_name = $user_name;
    }

    /**
     * @return string
     */
    public function getUserMail(): string
    {
        return $this->user_mail;
    }

    /**
     * @param string $user_mail
     */
    public function setUserMail(string $user_mail): void
    {
        $this->user_mail = $user_mail;
    }

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->user_password;
    }

    /**
     * @param string $user_password
     */
    public function setUserPassword(string $user_password): void
    {
        $this->user_password = password_hash($user_password,PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function getUserRoleRoleId(): int
    {
        return $this->user_role_role_id;
    }

    /**
     * @param int $user_role_role_id
     */
    public function setUserRoleRoleId(int $user_role_role_id): void
    {
        $this->user_role_role_id = $user_role_role_id;
    }

    /**
     * @return string
     */
    public function getUserPhoto():string
    {
        return $this->user_photo;
    }

    /**
     * @param string $user_photo
     */
    public function setUserPhoto(string $user_photo): void
    {
        $this->user_photo = $user_photo;
    }
    /**
     * @return \DateTime
     */
    public function getUserDateinscription():DateTime
    {
        if (is_string($this->user_dateinscription)){
            $this->user_dateinscription = new DateTime($this->user_dateinscription);
        }
        return $this->user_dateinscription ?? '';
    }
    /**
     * @param \DateTime $user_dateInscription
     */
    public function setUserDateInscription(\DateTime $user_dateInscription): void
    {
        $this->user_dateInscription = $user_dateInscription;
    }

    /**récupère le nom d'utilisateur, l'email et le mot de passe. Prepare la requete SQL pour le "Insert into"
     * @return string
     */

    public function getStrParamsSQL():string
    {
        $tab = [$this->user_name, $this->user_mail, $this->user_password];
        return "'".htmlentities(implode("','",$tab))."'";

    }


}
