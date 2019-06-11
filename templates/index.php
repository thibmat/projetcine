<?php
use src\Controller\IndexController;
$controller = new IndexController();
$datas = $controller->index();
extract($datas);
echo "<h1 style=\"margin-left:60px;\">Les derniers films </h1>";
echo "<main class='container'>";
echo "<div class=\"row justify-content-around\">";
foreach ($films as $film):?>
    <div class="card" style="width:30%; margin:10px; height:400px;overflow:hidden; border-radius:40px;padding:30px;">
        <figure style="width:50%;margin:auto;">
            <img src="/img/<?php echo $film->getFilmImageName()?>" class="card-img-top img-fluid mh-100 mw-100" alt="Image de <?php echo $film->getFilmTitre() ?>">
        </figure>
        <div class="card-body">
            <a href="film/<?=$film->getFilmId()?>">
                <h5 class="card-title w-100 text-center"><?=  "[".$film->getGenreLibelle()."] <strong>".$film->getFilmTitre()."</strong>";?></h5>
                <p class="card-text"><?php echo "<strong>Sortie le ".$film->getFilmDate()."</strong><br>".$film->truncate($film->getFilmSinopsys(),50,'(...)');?></p>
            </a>
        </div>
    </div>
<?php
endforeach;
?>

<?php
echo "</div></main>";
?>

