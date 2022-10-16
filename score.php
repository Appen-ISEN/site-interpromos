<?php

    /**
      * PHP version 8.1.11
      * 
      * @author Valentin Hervé <valentinherve60@gmail.com>
    */

    $sport = "";
    if(isset($_GET["sport"])){
        $sport = $_GET["sport"];
    }

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <title>
            <?php
                echo $sport;
            ?>
        </title>
        <link href="public_html/css/style.css" rel="stylesheet">
        <link href="public_html/css/style_score.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="bgcolor-main">
        <div id="main_container">
            <img src="public_html/img/InterPromo.png" id="logo">

            <div id="content">
                <div class="horizontal_menu menu" id="sport_selection">
                    <a href="index.php">Acceuil</a>
                    <a href="score.php?sport=basket" <?php if($sport == "basket"){ echo "class=\"active\" ";} ?>>Basket</a>
                    <a href="score.php?sport=handball" <?php if($sport == "handball"){ echo "class=\"active\" ";} ?>>Handball</a>
                    <a href="score.php?sport=badminton" <?php if($sport == "badminton"){ echo "class=\"active\" ";} ?>>Badminton</a>
                    <a href="score.php?sport=volley" <?php if($sport == "volley"){ echo "class=\"active\" ";} ?>>Volley</a>
                    <a href="score.php?sport=futsal" <?php if($sport == "futsal"){ echo "class=\"active\" ";} ?>>Futsal</a>
                </div>
                <hr>
                <div class="horizontal_menu menu" id="phase">
                    <p id="group-phase-button" class="active">Phases de poule</p>
                    <p id="bracket-phase-button">Phases éliminatoires</p>
                </div>

                <div class="frame" id="bracket"> <!-- --------------------------------------------------------------------------------------------------- -->
                    <div class="quarter-finals round">
                        <h1 class="round-title">Quarts de finale</h1>
                        <div class="match">
                            <div class="team winner">
                                <p class="seed">#1</p>
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">5</p>
                            </div>
                            <div class="team loser">
                                <p class="seed">#8</p>
                                <p class="promo">Profs</p>
                                <p class="team-name">La dream team</p>
                                <p class="team-score">3</p>
                            </div>
                        </div>
                        <div class="match">
                            <div class="team loser">
                                <p class="seed">#4</p>
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">2</p>
                            </div>
                            <div class="team winner">
                                <p class="seed">#5</p>
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">8</p>
                            </div>
                        </div>
                        <div class="match">
                            <div class="team">
                                <p class="seed">#2</p>
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">0</p>
                            </div>
                            <div class="team">
                                <p class="seed">#7</p>
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">1</p>
                            </div>
                        </div>
                        <div class="match">
                            <div class="team winner">
                                <p class="seed">#3</p>
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">2</p>
                            </div>
                            <div class="team loser">
                                <p class="seed">#6</p>
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">1</p>
                            </div>
                        </div>
                    </div>

                    <div class="braces">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace quarters-brace">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace quarters-brace">
                    </div>

                    <div class="semi-finals round">
                        <h1 class="round-title">Demi-finales</h1>
                        <div class="match">
                            <div class="team">
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">2</p>
                            </div>
                            <div class="team">
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">2</p>
                            </div>
                        </div>
                        <div class="match">
                            <div class="team">
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">3</p>
                            </div>
                            <div class="team">
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="braces">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace semi-brace">
                    </div>

                    <div class="final round">
                        <h1 class="round-title">Finale</h1>
                        <div class="match">
                            <div class="team gold-medal winner">
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">5</p>
                            </div>
                            <div class="team silver-medal loser">
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">2</p>
                            </div>
                        </div>
                    </div>

                    <div class="braces"><p> </p>
                    </div>

                    <div class="bronze-medal-game round">
                        <h1 class="round-title">Petite finale</h1>
                        <div class="match">
                            <div class="team bronze-medal winner">
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">3</p>
                            </div>
                            <div class="team loser">
                                <p class="promo">A3</p>
                                <p class="team-name">Les ravagés</p>
                                <p class="team-score">1</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="frame bgcolor-main" id="poules"> <!-- --------------------------------------------------------------------------------------------------- -->
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>A1-CIR</th>
                                <th>A1-CSI</th>
                                <th>A2-CIR</th>
                                <th>A2-CSI</th>
                                <th>A3</th>
                                <th>M1</th>
                                <th>M2</th>
                                <th>Rang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>A1-CIR</th>
                                <th>X</th>
                                <th>3-2</th>
                                <th>2-5</th>
                                <th>4-2</th>
                                <th>0-0</th>
                                <th>4-3</th>
                                <th>1-8</th>
                                <th>5</th>
                            </tr>
                            <tr>
                                <th>A1-CSI</th>
                                <th>7-5</th>
                                <th>X</th>
                                <th>2-5</th>
                                <th>4-2</th>
                                <th>0-0</th>
                                <th>4-3</th>
                                <th>1-8</th>
                                <th>1</th>
                            </tr>
                            <tr>
                                <th>A2-CIR</th>
                                <th>7-5</th>
                                <th>3-2</th>
                                <th>X</th>
                                <th>4-2</th>
                                <th>0-0</th>
                                <th>4-3</th>
                                <th>1-8</th>
                                <th>3</th>
                            </tr>
                            <tr>
                                <th>A2-CSI</th>
                                <th>1-2</th>
                                <th>3-2</th>
                                <th>2-5</th>
                                <th>X</th>
                                <th>0-0</th>
                                <th>4-3</th>
                                <th>1-8</th>
                                <th>6</th>
                            </tr>
                            <tr>
                                <th>A3</th>
                                <th>0-0</th>
                                <th>3-2</th>
                                <th>2-5</th>
                                <th>4-2</th>
                                <th>X</th>
                                <th>4-3</th>
                                <th>1-8</th>
                                <th>2</th>
                            </tr>
                            <tr>
                                <th>M1</th>
                                <th>1-2</th>
                                <th>3-2</th>
                                <th>2-5</th>
                                <th>4-2</th>
                                <th>0-0</th>
                                <th>X</th>
                                <th>1-8</th>
                                <th>4</th>
                            </tr>
                            <tr>
                                <th>M2</th>
                                <th>8-4</th>
                                <th>3-2</th>
                                <th>2-5</th>
                                <th>4-2</th>
                                <th>0-0</th>
                                <th>4-3</th>
                                <th>X</th>
                                <th>7</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <input class="ButtonDayNight" type="image" src="public_html/img/DAYnNGH.png" onclick="switchDarkMode()" />

        <script src="public_html/js/script.js"></script>
        <script src="public_html/js/script_score.js"></script>
    </body>
</html>