<?php
use src\Controller\listFilmsController;
if (!isset($_GET['min']) && !isset($_GET['max'])){
    $min = 0;
    $max = 6;
}else{
    $min = $_GET['min'];
    $max = $_GET['max'];
}
$controller = new listFilmsController();
$datas = $controller->listFilms($min,$max);
extract($datas);
?>
<h1 style="margin-left:60px;">Les films </h1>
    <main class='container'>
        <div class="row justify-content-around">
<?php
foreach ($films as $film):?>
    <a href="film?film_id=<?= $film->getFilmId()?>">
    <div class="card" style="width:30%; margin:10px; height:400px;overflow:hidden; border-radius:40px;padding:30px;">
            <figure style="width:50%;margin:auto;">
                <img src="/img/<?php echo $film->getFilmImageName()?>" class="card-img-top img-fluid mh-100 mw-100" alt="Image de <?php echo $film->getFilmTitre() ?>">
            </figure>
            <div class="card-body">
                <h5 class="card-title w-100 text-center"><?php echo "<strong>".$film->getFilmTitre()."</strong>";?></h5>
                <p class="card-text"><?php echo "<strong>Sortie le : ".$film->getFilmDate()."</strong><br>".$film->getFilmSynopsis();?></p>
            </div>
            <div class="card-footer">
                <a href="?film_id=<?= $film->getFilmId();?>">Lire plus</a>
            </div>
    </div></a>
<?php
endforeach;
?>

<div style="width:100%;margin:auto;text-align:center;">
    <?php
    if ($min != 0){
    ?>
    <a href="?min=<?= $min-6;?>&&max=<?= $max-6;?>"><<</a>
    <?php
    }
    ?>

    <a href="?min=<?= $max;?>&&max=<?= $max+6;?>">>></a>
</div>
 </div></main>";

