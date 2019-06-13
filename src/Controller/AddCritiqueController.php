<?php
namespace src\Controller;
use src\Entity\Critique;
use src\Utilities\Database;
use src\Utilities\FormValidator;

class AddCritiqueController
{
    public function addcritique(?int $critiqueId = 0):array
    {
        $formValidator = new FormValidator();
        $errors = [];
        $critique = new Critique();
        $success = 0;
        $critiqueId = $this->addrecupId();
        $critiqueId=intval($critiqueId['critique_id']);
        $valider = "Ajouter la critique";
        if (isset($critiqueId) && $critiqueId != 0) {
            $critique = $critique->detailCritique($critiqueId,Critique::class);
            $valider = "Mettre à jour la critique";
        }
        $titre = $_POST['critique_titre'] ?? $critique->getCritiqueTitre() ?? '';
        $contenu = $_POST['critique_contenu'] ?? $critique->getCritiqueTitre() ?? '';
        //Verification formulaire + inscription de l'utilisateur en bdd
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = $formValidator->validate([
                ['critique_titre', 'text', 150],
                ['critique_contenu', 'text', 65000]
            ]);
            $isError = false;
            foreach ($errors as $error) {
                if($error !== '') {
                    $isError = true;
                }
            }
            if (!$isError) {
                //var_dump("On peut creer la critique");
                $database = new Database();
                // On crée un utilisateur en local
                $critique->setCritiqueTitre($_POST['critique_titre']);
                $critique->setCritiqueContenu($_POST['critique_contenu']);
                $filmId = $_POST['film_id'];
                $user = $_SESSION['user_id'];
                $query = "INSERT INTO critique (critique_titre, critique_contenu, user_id, film_id, critique_date) VALUES (".$database->getStrParamsGlobalSQL($critique->getCritiqueTitre(),$critique->getCritiqueContenu(),$user, $filmId).",NOW())";
                try{
                    $success = $database->exec($query);
                }catch(\PDOException $e){
                        throw new \Exception('PDOException dans registerController');
                }
            }
        }
        return compact('errors', 'success', 'critique', 'formValidator', 'titre', 'contenu', 'valider');
    }

    /**
     * Cette fonction récupère l'ID du film dans la barre d'adresse
     * @return int
     */
    public function addrecupId():array
    {
        $url = $_SERVER['REQUEST_URI'];
        $ids = explode('/',substr($url, 13));
        $filmId = $ids[0];
        $critique_id = $ids[1]  ?? '';
        return compact('filmId','critique_id');
    }
}