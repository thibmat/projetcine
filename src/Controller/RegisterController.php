<?php
namespace src\Controller;
use src\Entity\User;
use src\Utilities\Database;
use src\Utilities\FormValidator;

class RegisterController {

    public function register():array
    {
        $formValidator = new FormValidator();
        $errors = [];
        $user = new User();
        $success = 0;
        //Verification formulaire + inscription de l'utilisateur en bdd
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = $formValidator->validate([
                ['username', 'text', 128],
                ['email', 'text', 128],
                ['password', 'text', 128]
            ]);
            $isError = false;
            foreach ($errors as $error) {
                if($error !== '') {
                    $isError = true;
                }
            }
            if (!$isError) {
                //var_dump("On peut inscrire l'utilisateur");
                $database = new Database();
                // On crée un utilisateur en local

                $user->setUserName($_POST['username']);
                $user->setUserMail($_POST['email']);
                $user->setUserPassword($_POST['password']);

                $query = "INSERT INTO app_user (user_name, user_mail, user_password) VALUES (".$database->getStrParamsGlobalSQL($user->getUsername(),$user->getUserMail(),$user->getUserPassword()).")";

                try{
                    $success = $database->exec($query);
                }catch(\PDOException $e){
                    if ($e->getCode() == '23000'){
                        $errorMessageEmail = 'Email Deja utilisé';
                    } else {
                        throw new \Exception('PDOException dans registerController');
                    }
                }

            }
        }
        return compact('errors', 'success', 'user', 'formValidator');
    }
}




