<?php
use src\Entity\Film;
use src\Controller\AddFilmController;
use src\Utilities\FormValidator;
$controller = new AddFilmController();
$datas = $controller->verifAddFilm();
extract($datas);
$formValidator = new FormValidator();
?>
    <main class="container">
        <?php if(isset($success) && $success === 1) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Film ajouté : <?= $film->getFilmTitre()?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <h1>Ajout de film dans la base de données</h1>
        <form method="post" enctype="multipart/form-data">

            <?= $formValidator->generateInputText('film_titre', 'text','Titre du film',$errors,$titre) ?>
            <?= $formValidator->generateInputText('film_date', 'date','Date de sortie',$errors,$date) ?>
            <?= $formValidator->generateInputTextarea('film_sinopsys', 'Synopsis',7,$errors,$sinopsys) ?>
            <div class="form-group">
                <label for="genre_id">Genre : </label>
                <select class="form-control" id="genre_id" name="genre_id">
                <?php foreach($genres as $genre):
                if ($genreFilm == $genre->getGenreId()){?>
                    <option value="<?=$genre->getGenreId();?>" selected><?=$genre->getGenreLibelle()?></option>
                <?php }else{
                ?>
                    <option value="<?=$genre->getGenreId();?>"><?=$genre->getGenreLibelle()?></option>
                <?php } endforeach; ?>
                </select>
            </div>
            <div class="form-group">

                <label for="film_image_name">Affiche :</label>
                <input type="file" class="form-control-file" id="film_image_name" name="film_image_name">
                <div class="invalid-feedback d-block"><?= $errors['film_image_name'] ?? ''?></div>
            </div>
<?php

                ?>
                <input type="hidden" name="update" value="<?= $update ?>"/>
                <?php

?>
            <input type="submit" value="<?= $valider ?>" class="btn btn-outline-success">
        </form>
    </main>
<?php
?>