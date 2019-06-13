<?php
use src\Controller\IndexController;
$controller = new IndexController();
$datas = $controller->index();
extract($datas);
?>
<main class='container'>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Le film de la semaine</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
            <p>
                <a href="#" class="btn btn-primary my-2">Main call to action</a>
                <a href="#" class="btn btn-secondary my-2">Secondary action</a>
            </p>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

<?php
foreach ($films as $film):?>

                <div class="col-md-4">
                    <div class="card mb-4 box-shadow ">
                        <img class="card-img-top img-fluid" src="/img/<?= $film->getFilmImageName()?>" alt="Image de <?= $film->getFilmTitre()?>" style="height:400px;">
                        <div class="card-body">
                            <h5 class="card-title w-100"><span style="font-size:70%;"><?= "[".$film->getGenreLibelle()."]</span><br><strong>".$film->getFilmTitre()."</strong>";?></h5>
                            <p class="card-text "><?= "<strong>Sortie le ".$film->getFilmDate()."</strong><br>".$film->truncate($film->getFilmSinopsys(),50,' (...)');?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group mx-auto">
                                    <a href="film/<?=$film->getFilmId()?>"><button type="button" class="btn btn-sm btn-outline-secondary">Details</button></a>
                                    <?php
                                    if (isset($_SESSION['user_role']) && $_SESSION['user_role']>=2) {
                                        ?>
                                        <a href="../addFilm/<?= $film->getFilmId(); ?>">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Editer
                                            </button>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
endforeach;
?>
            </div>
        </div>
    </div>
</main>


