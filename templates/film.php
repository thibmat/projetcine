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
        <header style="background-color:#666;color:white;width:100%;border-radius:10px;padding:10px">
            <h1 style="display:inline"><?= $filmdetail->getFilmTitre()." (".$filmdetail->getGenreLibelle().")";?></h1>
            <div class="text-right">
            <?php
            if (isset($_SESSION['user_role']) && $_SESSION['user_role']>=2){?><a href="../addFilm/<?= $filmdetail->getFilmId();?>"><img src="/img/divers/modify.svg" alt="Modifier cette critique" style="width:15px;"/></a>
                <?php
                if ($_SESSION['user_role'] === 3) {
                    ?>
                    <a href="/films/delete/<?= $filmdetail->getFilmId(); ?>"><img src="/img/divers/trash.svg"

                                                                                                            alt="Supprimer cette critique"
                                                                                                            style="width:15px;"/></a>
                    <?php
                }
            }
            ?>
            </div>
        </header>
        <figure style="width:50%;margin:auto;margin-top:20px;">
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
                <p class="card-text"><a href="/membre/<?=$critique->user_id;?>"><img src='/img/<?=$critique->user_photo;?>' style='width:50px;border-radius:50%;'></a><strong> <?= $critique->getCritiqueTitre()."</strong><span> écrit par : ".$critique->user_name."</span><span> le ". $critique->getCritiqueDate()->format("d-m-Y à H:i")."</span><br>".$critique->getCritiqueContenu();?></p>
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