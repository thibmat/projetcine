<?php
use src\Controller\ValidCritiquesController;
$controller = new ValidCritiquesController();
$action = $controller->recupAdresse();
if ($action != null){
    extract($action);
}
$datas = $controller->listValidCritiqueFilms();
extract($datas);
if($_SESSION['user_role']>=2) {
    ?>

    <main class="container">
        <?php if(isset($message) && $message != '') : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Succès : <?= $message ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
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
            <?php foreach ($films as $film): ?>
                <tr>
                    <td class="text-center align-middle"><?= $film->critique_id; ?></td>
                    <td class="text-center align-middle"><?= $film->critique_titre; ?></td>
                    <td class="text-center align-middle"><?= $film->critique_contenu; ?></td>
                    <td class="text-center align-middle"><?= $film->getFilmTitre(); ?></td>
                    <td class="text-center align-middle">
                        <a href="/validcritiques/valid/<?= $film->critique_id; ?>"><img src="/img/divers/valid.svg"
                                                                                  alt="Valider cette critique"
                                                                                  style="width:15px;"/></a>
                        <a href="/addcritique/<?= $film->getFilmId()."/".$film->critique_id;?>"><img src="/img/divers/modify.svg"
                                                                                  alt="Modifier cette critique"
                                                                                  style="width:15px;"/></a>
                        <a href="/validcritiques/delete/<?= $film->critique_id; ?>"><img src="/img/divers/trash.svg"
                                                                                  alt="Supprimer cette critique"
                                                                                  style="width:15px;"/></a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </main>
    <?php
}else{
    echo 'Vous devez être connecté pour acceder à ce contenu';
}
?>
