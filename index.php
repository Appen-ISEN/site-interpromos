<?php

/**
 * PHP version 8.1.11
 * 
 * @author Valentin Hervé <valentinherve60@gmail.com>
 */

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Accueil</title>
        <link href="public_html/css/style.css" rel="stylesheet">
        <link href="public_html/css/colors.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container"></div>
        <img src="public_html/img/InterPromo.png">
        <input class="ButtonDayNight" type="image" src="public_html/img/DAYnNGH.png" onclick="switchDarkMode()" />
        <div class="vertical_menu menu">
            <a href="" class="color-main active">Acceuil</a>
            <a href="score.php?sport=basket" class="color-main bgcolor-btnprimary">Basket</a>
            <a href="score.php?sport=handball" class="color-main bgcolor-btnprimary">Handball</a>
            <a href="score.php?sport=badminton" class="color-main bgcolor-btnprimary">Badminton</a>
            <a href="score.php?sport=volley" class="color-main bgcolor-btnprimary">Volley</a>
            <a href="score.php?sport=futsal" class="color-main bgcolor-btnprimary">Futsal</a>
        </div>

        <script src="public_html/js/script.js"></script>
    </body>

</hmtl>