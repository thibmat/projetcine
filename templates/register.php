<?php
use src\Controller\RegisterController;
$controller = new RegisterController();
$datas = $controller->register();
extract($datas);
?>
    <main class="container">
        <?php if(isset($success) && $success === 1) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Utilisateur inscrit : Bonjour <?= (isset($user)) ? $user->getUsername() : '' ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <h1>Inscription</h1>
        <form method="post" enctype="multipart/form-data">
            <?= $formValidator->generateInputText('username', 'text','Nom d\'utilisateur',$errors) ?>
            <?= $formValidator->generateInputText('email', 'email','Adresse email',$errors) ?>
            <?= $formValidator->generateInputText('password', 'password','Mot de passe',$errors) ?>

            <div class="form-group">

                <label for="user_photo">Avatar :</label>
                <input type="file" class="form-control-file" id="user_photo" name="user_photo">
                <div class="invalid-feedback d-block"><?= $errors['user_photo'] ?? ''?></div>
            </div>

            <input type="submit" value="S'inscrire" class="btn btn-outline-success">
        </form>
    </main>
<?php
?>