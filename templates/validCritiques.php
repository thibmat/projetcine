<?php
use src\Controller\ValidCritiquesController;
$controller = new ValidCritiquesController();
$datas = $controller->listValidCritiqueFilms();
extract($datas);



?>

<main class="container">
    <table class="table table-hover table-dark table-bordered">
        <thead>
        <tr>
            <th scope="col" class="text-center align-middle">ID CRITIQUE</th>
            <th scope="col" class="text-center align-middle">TITRE CRITIQUE</th>
            <th scope="col" class="text-center align-middle">CONTENU CRITIQUE</th>
            <th scope="col" class="text-center align-middle">FILM</th>
            <th scope="col" class="text-center align-middle">ACTION</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($films as $film):?>
            <tr>
                <td class="text-center align-middle"><?= $film->critique_id; ?></td>
                <td class="text-center align-middle"><?= $film->critique_titre; ?></td>
                <td class="text-center align-middle"><?= $film->critique_contenu; ?></td>
                <td class="text-center align-middle"><?= $film->getFilmTitre(); ?></td>
                <td class="text-center align-middle">
                    <a href="/validcritiques/<?= $film->critique_id;?>"><img src="/img/divers/valid.svg" alt="Valider cette critique" style="width:15px;"/></a>
                    <a href="/validcritiques/<?= $film->critique_id;?>"><img src="/img/divers/modify.svg" alt="Modifier cette critique" style="width:15px;"/></a>
                    <a href="/validcritiques/<?= $film->critique_id;?>"><img src="/img/divers/trash.svg" alt="Supprimer cette critique"style="width:15px;"/></a>
                </td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</main>
