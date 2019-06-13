<?php
use src\Entity\Film;
use src\Entity\Critique;
$film = new Film();
$filmId = $film->recupId();
extract($filmId);
$filmId = intval($filmId['id']);
$critiques = new Critique();
$datas = $critiques->listCritiques($filmId);
extract($datas);
$filmdetail = $film->detailFilms($filmId,Film::class);

?>
<main class='container'>

    <div class="card" style="width:100%; margin:10px; border-radius:40px;padding:30px;">
        <h1 style="margin-left:60px;"><?= $filmdetail->getFilmTitre()." (".$filmdetail->getGenreLibelle().")";?> </h1>
        <?php
        if (isset($_SESSION['user_role']) && $_SESSION['user_role']>=2){?><a href="../addFilm/<?= $filmdetail->getFilmId();?>">Modifier le film</a>
        <?php
            if ($_SESSION['user_role'] === 3) {
                ?>
                <a href="/films/delete/<?= $filmdetail->getFilmId(); ?>">Supprimer</a>
                <?php
            }
        }
        ?>
        <figure style="width:50%;margin:auto;">
            <img src="/img/<?php echo $filmdetail->getFilmImageName()?>" class="card-img-top img-fluid mh-100 mw-100" alt="Image de <?php echo $filmdetail->getFilmTitre() ?>">
        </figure>
        <div class="card-body">
                <p class="card-text"><?php echo "<strong>Sortie le ".$filmdetail->getFilmDate()."</strong><br>".$filmdetail->getFilmSinopsys();?></p>

        </div>
    </div>
    <div class="card" style="width:100%; margin:10px; border-radius:40px;padding:30px;">
        <h2>Les critiques</h2>
        <div class="card-body">
            <?php

            foreach ($critiques as $critique):
            ?>
                <p class="card-text"><strong><?= $critique->getCritiqueTitre()."</strong><span> écrit par : ".$critique->user_name."</span><span> le ". $critique->getCritiqueDate()->format("d-m-Y à H:i")."</span><br>".$critique->getCritiqueContenu();?></p>
            <?php endforeach;?>
        </div>
        <div class="text-right">
        <?php
        if (isset($_SESSION['username'])){
        ?>
            <a href="/addcritique/<?=$filmdetail->getFilmId()?>">Rédiger une critique </a>
        <?php
        }
        ?>
        </div>
    </div>
</main>