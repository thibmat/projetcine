<?php
use src\Entity\Film;
use src\Controller\AddFilmController;
use src\Entity\Genre;

$controller = new AddFilmController();
$datas = $controller->verifAddFilm();
$genre = new Genre();
$genres = $genre->recupGenre();
extract($datas);
if (isset($_GET['filmId']))
{
    $datas = new film();
    $film = $datas->detailFilms($_GET['filmId'],Film::class);
    $titre = $film->getFilmTitre();
    $date = $film->getFilmDate();
    $sinopsys = $film->getFilmSinopsys();
    $genreFilm = $film->getGenreId();
    $imageName = $film->getFilmImageName();
    $valider = "Mettre à jour le film";
    $update = $film->getFilmId();
}elseif (!empty($_POST)){
    $titre = $_POST['film_titre'];
    $date = $_POST['film_date'];
    $sinopsys = $_POST['film_sinopsys'];
    $genreFilm = $_POST['genre_id'];
    $imageName = $_POST['film_image_name'];
    $valider = "Ajouter le film";
    $update = 0;
}else{
    $valider = "Ajouter le film";
    $update = 0;
}
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
        <form method="post">
            <div class="form-group">
                <label for="film_titre">Titre du film</label>
                <input type="text" class="form-control <?= (isset($errorMessageTitre) && !empty($errorMessageTitre)) ? 'is-invalid' : '' ?>" id="username" name="film_titre" placeholder="Titre du Film" value="<?= $titre ?? ''?>">
                <div class="invalid-feedback"><?= $errorMessageTitre ?? "" ?></div>
            </div>

            <div class="form-group">
                <label for="film_date">Date de sortie</label>
                <input type="date" class="form-control <?= (isset($errorMessageDate) && !empty($errorMessageDate)) ? 'is-invalid' : '' ?>" id="film_date" name="film_date" placeholder="Date de sortie" value="<?= $date ?? ''?>">
                <div class="invalid-feedback"><?= $errorMessageDate ?? "" ?></div>
            </div>

            <div class="form-group">
                <label for="film_sinopsys">Synopsis</label>
                <textarea class="form-control" id="film_sinopsys" name="film_sinopsys" rows="7" ><?= $sinopsys ?? ''?></textarea>
                <div class="invalid-feedback"><?= $errorMessageSinopsys ?? "" ?></div>
            </div>

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
                <label for="film_image_name">Affiche</label>
                <input type="file" class="form-control-file" id="film_image_name" name="film_image_name">
                <input type="text" class="form-control" disabled='disabled' value="<?php if (isset($imageName)) echo $imageName;?>" />
            </div>
<?php
            if(isset($update) && $update != 0) {
                ?>
                <input type="hidden" name="update" value="<?= $update ?>"/>
                <?php
            }
?>
            <input type="submit" value="<?= $valider ?>" class="btn btn-outline-success">
        </form>
    </main>
<?php
?>