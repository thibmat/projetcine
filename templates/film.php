<?php
use src\Entity\Film;
$film_id = $_GET['film_id'];
$film = new Film();
$detailfilm = $film->detailFilms($film_id);
var_dump($detailfilm);
?>

