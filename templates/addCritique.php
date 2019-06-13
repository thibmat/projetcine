<?php
use src\Controller\AddCritiqueController;
use src\Entity\Film;
$controller = new AddCritiqueController();
$transport = $controller->addrecupId();
extract($transport);
$film = new Film();
$filmdetails=$film->detailFilms($filmId,Film::class);
$datas = $controller->addcritique();
extract($datas);
?>
    <main class="container">

        <?php if(isset($success) && $success === 1) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                La critique <?= (isset($critique)) ? $critique->getCritiqueTitre() : '' ?> a bien été envoyée, Elle est en attente de validation.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <h1>Rédiger une critique pour le film "<?= $filmdetails->getFilmTitre();?>"</h1>
        <form method="post">
            <?= $formValidator->generateInputText('critique_titre', 'text','Titre de la critique',$errors, $titre) ?>
            <?= $formValidator->generateInputTextarea('critique_contenu', 'text',5,$errors, $contenu) ?>
            <input type="hidden" name="film_id" value="<?= $filmId ?>"/>
            <input type="submit" value="<?=$valider;?>" class="btn btn-outline-success">
        </form>
    </main>
<?php
?>