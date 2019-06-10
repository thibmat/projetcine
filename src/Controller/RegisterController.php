<?php
namespace src\Controller;
use src\Entity\User;
use src\Utilities\Database;
use src\Utilities\FormValidator;

class RegisterController {

    public function register():array
    {
        //Verification formulaire + inscription de l'utilisateur en bdd
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errorMessageUsername = FormValidator::checkPostText('username', 128);
            $errorMessageEmail = FormValidator::checkPostEmail('email', 255);
            $errorMessagePassword = FormValidator::checkPostText('password', 100);

            if (empty($errorMessageUsername) && empty($errorMessagePassword) && empty($errorMessageEmail)){

                //var_dump("On peut inscrire l'utilisateur");
                $database = new Database();

                // On crée un utilisateur en local
                $user = new User($_POST['username'],$_POST['email'],$_POST['password']);

                $query = "INSERT INTO app_user (user_name, user_mail, user_password) VALUES (".$database->getStrParamsGlobalSQL($user->getUsername(),$user->getEmail(),$user->getPassword()).")";
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
        return compact ('success','errorMessageUsername','errorMessageEmail','errorMessagePassword',"user");
    }
}




