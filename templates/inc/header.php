<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MONDOCINE</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body style="background:lightgrey;">
<nav>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row ">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">A Propos</h4>
                        <p class="text-muted">A chacun son cinéma. Cinéphile ou simple amateur à la recherche d'un avis, Mondociné vous parle de tout. Retrouvez nos critiques, l'actualité ciné & vidéo..</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 mr-12 py-4">
                        <h4 class="text-white text-right">Section membre</h4>
                        <ul class="list-unstyled">
                            <?php
                            if (isset($_SESSION['username'])) {
                                ?>
                            <li class='text-right'><a class="text-white text-right" href="/membre/<?=$_SESSION['user_id']?>" >
                                    <?php
                                    echo $_SESSION['username']."(".$_SESSION['user_role'].")";
                                    ?>
                                </a></li>
                                <?php
                                echo "<li class='text-right'><a class=\"text-white\" href='?exit=yes'>Se déconnecter</a></li>";
                            }else{
                                echo "<li class='text-right'><a class=\"text-white\" href=\"/index.php/connexion\">Se connecter </a></li>";
                                echo "<li class='text-right'><a class=\"text-white\" href=\"/index.php/inscription\">Créer un compte</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="/index.php" class="navbar-brand d-flex align-items-center">
                        <img src="/img/divers/logo.svg" width="30" height="30" style="color:white"/>
                    <strong>Mondocine</strong>
                </a>
                    <a class="text-white" href="/index.php">Accueil <span class="sr-only">(current)</span></a>
                    <a class="text-white" href="/films">Les Films</a>
                    <li class="nav-item dropdown" style="list-style-type: none;">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Administration
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                            if (isset($_SESSION['username']) && $_SESSION['user_role'] >= 2) {
                                ?>
                                <a class="dropdown-item" href="/addFilm">Ajouter un Film</a>
                                <a class="dropdown-item" href="/validcritiques">Modérer les critiques</a>
                                <a class="dropdown-item" href="/addGenre">Gerer les genres de films</a>
                                <?php
                            }
                            ?>
                        </div>
                    </li>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>
</nav>


