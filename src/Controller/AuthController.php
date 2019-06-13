<?php
namespace src\Controller;
use src\Entity\User;
use src\Utilities\Database;
use src\Utilities\FormValidator;
class AuthController
{
    /**
     * Verifie les identifiants et connecte l'utilisateur
     * @return array
     */
    public function connectUser(): array
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errorMessageEmail = FormValidator::checkPostEmail('email', 255);
            $errorMessagePassword = FormValidator::checkPostText('password', 128);
            if (empty($errorMessageEmail) && empty($errorMessagePassword)) {
                // Il n'y a pas d'erreur, on passe à l'inscription
                $database = new Database();
                $database->connect();
                // On crée un utilisateur en local
                $user = new User();

                $queryVerif = "SELECT * FROM app_user WHERE  user_mail='" . $_POST['email'] . "'";
                $userConnect = $database->queryUnique($queryVerif, User::class);
                if ($userConnect) {
                    if (password_verify($_POST['password'], $userConnect->getUserPassword())) {
                        $username = $userConnect->getUserName();
                        $user_role = $userConnect->getUserRoleRoleId();
                        $user_id = $userConnect->getUserId();
                        $success = 1;
                    } else {
                        $success = 0;
                        $errorMessage = 'Le mot de passe rentré ne correspond pas';
                    }
                } else {
                    $username = '';
                    $user_role = 0;
                    $success = 0;
                    $errorMessage = 'Nous n\'avons pas trouvé d\'utilisateur avec ce mail';
                }
                return compact('username', 'success', 'user_role', 'errorMessage','user_id');
            }
        }
    }
}