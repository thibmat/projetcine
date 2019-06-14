<?php
use src\Controller\AddGenreController;
use src\Utilities\FormValidator;
$controller = new AddGenreController();
$formValidator = new FormValidator();
$datas = $controller->addGenre();
$genres = $controller->recupGenres();

extract($datas);
?>
    <main class="container">
        <?php if(isset($success) && $success === 1) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Genre ajouté : <?= $genre->getGenreLibelle()?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <h1 class="my-5">Ajout de genre dans la base de données</h1>
        <section class=" h-50 w-100 mx-auto text-center" >
            <h4>Les genres de film</h4>
            <?php
            foreach($genres as $genre){
                ?>
            <a href="/addGenre/<?=$genre->getGenreId()?>"><button type="button" class="btn btn-sm btn-outline-secondary"><?=$genre->getGenreLibelle();?>
                </button></a>
                <?php
            }
            ?>
        </section>

        <form method="post" class="my-5">

            <?= $formValidator->generateInputText('genre_libelle', 'text','Libelle du genre',$errors,$genre_libelle) ?>

            <input type="submit" value="<?= $valider ?>" class="btn btn-outline-success">
        </form>
    </main>
<?php
?>