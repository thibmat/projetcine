<?php
use src\Controller\listFilmsController;
$controller = new listFilmsController();
$datas1 = $controller->recupMinMax();
extract($datas1);
$nbFilms = $controller->nbreFilmsTotal();
$nbPages = $nbFilms % 6;
$min = intval($minmax[0]);
$max = intval($minmax[1]);
$datas = $controller->listFilms($min,$max);
extract($datas);
?>
<h1 style="margin-left:60px;">Les films </h1>
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
            <div class="card" style="width:30%; margin:10px; height:400px;overflow:hidden; border-radius:40px;padding:30px;">
                    <figure style="width:50%;margin:auto;">
                        <img src="/img/<?php echo $film->getFilmImageName()?>" class="card-img-top img-fluid mh-100 mw-100" alt="Image de <?php echo $film->getFilmTitre() ?>">
                    </figure>
                    <div class="card-body">
                        <a href="/film/<?=$film->getFilmId()?>">
                            <h5 class="card-title w-100 text-center"><?php echo "<strong>".$film->getFilmTitre()."</strong>";?></h5>
                            <p class="card-text"><?php echo "<strong>Sortie le ".$film->getFilmDate()."</strong><br>".$film->truncate($film->getFilmSinopsys(),80,'(...)');?></p>
                        </a>
                        <?php
                        if (array_key_exists('user_role',$_SESSION) && $_SESSION['user_role'] >= 2){
                            echo "<div class=\"card-footer\"><a href=\"../addFilm/".$film->getFilmId()."\">Modifier</a></div>";
                        }
                        ?>

                    </div>

            </div>
<?php
endforeach;
?>
            <div style="width:100%;margin:auto;text-align:center;">
                <?php
                if ($min != 0){
                ?>
                <a href="/films/<?= $min-6;?>/<?= $max-6;?>"><<</a>
                <?php
                }
                if ($max<=($nbPages*6)) {
                    ?>
                    <a href="/films/<?= $max; ?>/<?= $max + 6; ?>">>></a>
                <?php
                }
                ?>
            </div>
        </div>
</main>

