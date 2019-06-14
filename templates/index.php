<?php
use src\Controller\IndexController;
$controller = new IndexController();
$datas = $controller->index();
$datas2 = $controller->sortieSemaine();
extract($datas2);
$nbSorties = sizeof($filmsSemaine);
extract($datas);
?>
<main class='container'>
    <section class="jumbotron text-center">
        <div class="overlay"><h1>Les sorties de la semaine</h1></div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
                <ol class="carousel-indicators">
                    <?php
                    for ($i=0;$i<$nbSorties;$i++) {
                        ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>"></li>
                        <?php
                    }
                    ?>
                </ol>
                <div class="carousel-inner" >
                    <div class="carousel-item active">
                    <?php
                    foreach ($filmsSemaine as $filmSemaine):
                    $nbSorties --;
                    ?>
                            <img class="d-block mx-auto" src="/img<?=$filmSemaine->getFilmImageName();?>" alt="<?=$filmSemaine->getFilmTitre();?>">

                            <div class="carousel-caption d-none d-md-block" style="background-color:rgba(0,0,0,0.50);padding:30px;">

                                <h5><?= $filmSemaine->getFilmTitre();?></h5>
                                <p><?= $filmSemaine->truncate($filmSemaine->getFilmSinopsys(),100,' (...)');?></p>


                            </div>
                        </div>
                    <?php
                    if ($nbSorties != 0){
                    ?>
                        <div class="carousel-item">
                    <?php
                    }

                    endforeach;
                ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                    <span class="sr-only">Précédent</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Suivant</span>
                </a>
            </div>

    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

<?php
foreach ($films as $film):?>

                <div class="col-md-4 p-1">
                    <div class="card mb-4 box-shadow ">
                        <img class="card-img-top" src="/img/<?= $film->getFilmImageName()?>" alt="Image de <?= $film->getFilmTitre()?>" style="height:400px;width:300px; margin:auto;">
                        <div class="card-body">
                            <h5 class="card-title w-100"><span style="font-size:70%;"><?= "[".$film->getGenreLibelle()."]</span><br><strong>".$film->getFilmTitre()."</strong>";?></h5>
                            <p class="card-text "><?= "<strong>Sortie le ".$film->getFilmDate()->format('d/m/Y')."</strong><br>".$film->truncate($film->getFilmSinopsys(),55,' (...)');?></p>
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


