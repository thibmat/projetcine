<?php
use src\Controller\listFilmsController;

if(array_key_exists('min',$_GET) || array_key_exists('max',$_GET)){
    $min = intval($_GET['min']);
    $max = intval($_GET['max']);
}else{
    $min = 0;
    $max = 6;
}

$controller = new listFilmsController();
$datas1 = $controller->recupMinMax($min, $max);
extract($datas1);
if ($action !== 'filter'){
    $datas = $controller->listFilms($min,$max);
    extract($datas);
    $nbFilms = $controller->nbreFilmsTotal();
}
$nbPages = $nbFilms % 6;
$genres = $controller->recupGenres();
$annees = $controller->recupAnnees();
$annees = array_unique($annees);
?>
<h1 style="margin-left:60px;">Les films </h1>
<div class="album py-5 bg-light">
    <div class="container">
        <section class="filtres w-100 mx-auto text-center" >
            <h4>Filtres</h4>
            <?php
            foreach($genres as $genre){
                ?>
                <a href="/films/filter/genre/<?=$genre->getGenreId()?>"><button type="button" class="btn btn-sm btn-outline-secondary"><?=$genre->getGenreLibelle();?>
                </button></a>
            <?php
            }
            ?>
            <?php
            foreach($annees as $annee){
                ?>
                <a href="/films/filter/annee/<?=$annee?>"><button type="button" class="btn btn-sm btn-outline-secondary"><?=$annee;?>
                </button></a>
                <?php
            }
            ?>
        </section>
        <div class="row mt-3">
            <main class='container'>
                <?php if(isset($delete) && $delete === 1) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Film Supprimé avec succès
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="row justify-content-around">

            <?php
            foreach ($films as $film):?>

                <div class="col-md-4 p-1">
                    <div class="card mb-4 box-shadow ">
                        <img class="card-img-top" src="/img/<?= $film->getFilmImageName()?>" alt="Image de <?= $film->getFilmTitre()?>" style="height:400px;width:300px; margin:auto;">
                        <div class="card-body">
                            <h5 class="card-title w-100"><span style="font-size:70%;"><?= "[".$film->getGenreLibelle()."]</span><br><strong>".$film->getFilmTitre()."</strong>";?></h5>
                            <p class="card-text "><?= "<strong>Sortie le ".$film->getFilmDate()->format('d/m/Y')."</strong><br>".$film->truncate($film->getFilmSinopsys(),50,' (...)');?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group mx-auto">
                                    <a href="/film/<?=$film->getFilmId()?>"><button type="button" class="btn btn-sm btn-outline-secondary">Details</button></a>
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
    <div style="width:100%;margin:auto;text-align:center;">
        <?php
        if ($min != 0){
            ?>
            <a href="?min=<?= $min-6;?>&amp;max=<?= $max-6;?>"><<</a>
            <?php
        }
        if ($nbFilms > 6 && $max<($nbPages*6)) {
            ?>
            <a href="?min=<?= $max; ?>&amp;max=<?= $max + 6; ?>">>></a>
            <?php
        }
        ?>
    </div>
</div>
</main>