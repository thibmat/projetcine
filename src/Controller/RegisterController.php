<?php
namespace src\Controller;
use src\Entity\User;
use src\Utilities\Database;
use src\Utilities\FormValidator;
use DateTime;

class RegisterController {

    public function register():array
    {
        $formValidator = new FormValidator();
        $errors = [];
        $user = new User();
        $success = 0;
        $valider = "S'inscrire";
        //Verification formulaire + inscription de l'utilisateur en bdd
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = $formValidator->validate([
                ['username', 'text', 128],
                ['email', 'text', 128],
                ['password', 'text', 128],
                ['user_photo','file',2,'users', ['jpg'=>'image/jpeg','png'=>'image/png','jpeg'=>'image/jpeg','gif'=>'image/gif']]
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
                $user->setUserPhoto('/users/'.$_FILES['user_photo']["name"]);
                $query = "INSERT INTO app_user (user_name, user_mail, user_password, user_photo, user_dateinscription) VALUES (".$database->getStrParamsGlobalSQL($user->getUsername(),$user->getUserMail(),$user->getUserPassword(), $user->getUserPhoto()).",NOW())";
                try{
                    $success = $database->exec($query);
                }catch(\PDOException $e){
                    if ($e->getCode() == '23000'){
                        $errors[1] = 'Email Deja utilisé';
                    } else {
                        throw new \Exception('PDOException dans registerController');
                    }
                }
            }
        }
        return compact('errors', 'success', 'user', 'formValidator', 'valider');
    }
}




