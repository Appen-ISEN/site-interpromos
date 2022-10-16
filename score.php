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
        <link href="public_html/css/colors.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="bgcolor-main">
        <div id="main_container">
            <img src="public_html/img/InterPromo.png" id="logo">

            <div id="content">
                <div class="horizontal_menu menu" id="sport_selection">
                    <a href="index.php" class="bgcolor-btnprimary color-main">Acceuil</a>
                    <a href="score.php?sport=basket" class="color-main<?php if($sport == "basket"){ echo " active";} else{ echo " bgcolor-btnprimary";} ?>">Basket</a>
                    <a href="score.php?sport=handball" class="color-main<?php if($sport == "handball"){ echo " active";} else{ echo " bgcolor-btnprimary";} ?>">Handball</a>
                    <a href="score.php?sport=badminton" class="color-main<?php if($sport == "badminton"){ echo " active";} else{ echo " bgcolor-btnprimary";} ?>">Badminton</a>
                    <a href="score.php?sport=volley" class="color-main<?php if($sport == "volley"){ echo " active";} else{ echo " bgcolor-btnprimary";} ?>">Volley</a>
                    <a href="score.php?sport=futsal" class="color-main<?php if($sport == "futsal"){ echo " active";} else{ echo " bgcolor-btnprimary";} ?>">Futsal</a>
                </div>
                <hr>
                <div class="horizontal_menu menu" id="phase">
                    <p id="group-phase-button" class="color-main active">Phases de poule</p>
                    <p id="bracket-phase-button" class="bgcolor-btnprimary color-main">Phases éliminatoires</p>
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
                    <table class="color-main">
                        <thead>
                            <tr class="bgcolor-tableprimary">
                                <th class="bordercolor-main"></th>
                                <th class="bordercolor-main">A1-CIR</th>
                                <th class="bordercolor-main">A1-CSI</th>
                                <th class="bordercolor-main">A2-CIR</th>
                                <th class="bordercolor-main">A2-CSI</th>
                                <th class="bordercolor-main">A3</th>
                                <th class="bordercolor-main">M1</th>
                                <th class="bordercolor-main">M2</th>
                                <th class="bordercolor-main">Rang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bgcolor-tablesecondary">
                                <td class="bordercolor-main">A1-CIR</td>
                                <td class="bordercolor-main">X</td>
                                <td class="bordercolor-main">3-2</td>
                                <td class="bordercolor-main">2-5</td>
                                <td class="bordercolor-main">4-2</td>
                                <td class="bordercolor-main">0-0</td>
                                <td class="bordercolor-main">4-3</td>
                                <td class="bordercolor-main">1-8</td>
                                <td class="bordercolor-main">5</td>
                            </tr>
                            <tr class="bgcolor-tableprimary">
                                <td class="bordercolor-main">A1-CSI</td>
                                <td class="bordercolor-main">7-5</td>
                                <td class="bordercolor-main">X</td>
                                <td class="bordercolor-main">2-5</td>
                                <td class="bordercolor-main">4-2</td>
                                <td class="bordercolor-main">0-0</td>
                                <td class="bordercolor-main">4-3</td>
                                <td class="bordercolor-main">1-8</td>
                                <td class="bordercolor-main">1</td>
                            </tr>
                            <tr class="bgcolor-tablesecondary">
                                <td class="bordercolor-main">A2-CIR</td>
                                <td class="bordercolor-main">7-5</td>
                                <td class="bordercolor-main">3-2</td>
                                <td class="bordercolor-main">X</td>
                                <td class="bordercolor-main">4-2</td>
                                <td class="bordercolor-main">0-0</td>
                                <td class="bordercolor-main">4-3</td>
                                <td class="bordercolor-main">1-8</td>
                                <td class="bordercolor-main">3</td>
                            </tr>
                            <tr class="bgcolor-tableprimary">
                                <td class="bordercolor-main">A2-CSI</td>
                                <td class="bordercolor-main">1-2</td>
                                <td class="bordercolor-main">3-2</td>
                                <td class="bordercolor-main">2-5</td>
                                <td class="bordercolor-main">X</td>
                                <td class="bordercolor-main">0-0</td>
                                <td class="bordercolor-main">4-3</td>
                                <td class="bordercolor-main">1-8</td>
                                <td class="bordercolor-main">6</td>
                            </tr>
                            <tr class="bgcolor-tablesecondary">
                                <td class="bordercolor-main">A3</td>
                                <td class="bordercolor-main">0-0</td>
                                <td class="bordercolor-main">3-2</td>
                                <td class="bordercolor-main">2-5</td>
                                <td class="bordercolor-main">4-2</td>
                                <td class="bordercolor-main">X</td>
                                <td class="bordercolor-main">4-3</td>
                                <td class="bordercolor-main">1-8</td>
                                <td class="bordercolor-main">2</td>
                            </tr>
                            <tr class="bgcolor-tableprimary">
                                <td class="bordercolor-main">M1</td>
                                <td class="bordercolor-main">1-2</td>
                                <td class="bordercolor-main">3-2</td>
                                <td class="bordercolor-main">2-5</td>
                                <td class="bordercolor-main">4-2</td>
                                <td class="bordercolor-main">0-0</td>
                                <td class="bordercolor-main">X</td>
                                <td class="bordercolor-main">1-8</td>
                                <td class="bordercolor-main">4</td>
                            </tr>
                            <tr class="bgcolor-tablesecondary">
                                <td class="bordercolor-main">M2</td>
                                <td class="bordercolor-main">8-4</td>
                                <td class="bordercolor-main">3-2</td>
                                <td class="bordercolor-main">2-5</td>
                                <td class="bordercolor-main">4-2</td>
                                <td class="bordercolor-main">0-0</td>
                                <td class="bordercolor-main">4-3</td>
                                <td class="bordercolor-main">X</td>
                                <td class="bordercolor-main">7</td>
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