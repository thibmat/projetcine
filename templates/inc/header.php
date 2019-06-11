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
<nav class="navbar navbar-expand-md navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="../index.php">
        <img src="/img/divers/mondocine-logo.jpg" width="100px" height="auto" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/index.php">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/films">Les Films</a>
            </li>

        </ul>
        <p class="my-2 my-md-0">
            <?php
            if (isset($_SESSION['username'])) {
                echo $_SESSION['username']."(".$_SESSION['user_role'].")";
                echo "<br><a href='?exit=yes'>Se déconnecter</a>";
            }else{
                echo "<a href=\"/index.php/connexion\">Se connecter </a><br>";
                echo "<a href=\"/index.php/inscription\">Créer un compte</a>";
            }
            ?>
        </p>
    </div>
</nav>