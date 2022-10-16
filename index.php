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
        <link href="public_html/css/style_score.css" rel="stylesheet">
        <link href="public_html/css/styleList.css" rel="stylesheet">
        <link href="public_html/css/colors.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    </head>
    <body class="bgcolor-main">
        <div id="main_container">
            <img src="public_html/img/InterPromo.png" id="logo">
            <div class="color-main" id="content">
                <div class="horizontal_menu menu"  id="sport_selection">
                    <a href="" class="color-main active">Acceuil</a>
                    <a href="score.php?sport=basket" class="color-main bgcolor-btnprimary">Basket</a>
                    <a href="score.php?sport=handball" class="color-main bgcolor-btnprimary">Handball</a>
                    <a href="score.php?sport=badminton" class="color-main bgcolor-btnprimary">Badminton</a>
                    <a href="score.php?sport=volley" class="color-main bgcolor-btnprimary">Volley</a>
                    <a href="score.php?sport=futsal" class="color-main bgcolor-btnprimary">Futsal</a>        
                </div>
                <hr>
                <div class="match_list">
                    <div class="list" id="nowMatch">
                        <h3>Match(s) en cours :</h3>
                        <hr>
                    </div>
                    <div class="list" id="nextMatch">
                        <h3>Futurs Matchs :</h3>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <input class="ButtonDayNight" type="image" src="public_html/img/DAYnNGH.png" onclick="switchDarkMode()" />
        <script src="public_html/js/script.js"></script>
        <script src="public_html/js/script_direct.js"></script>
    </body>

</hmtl>