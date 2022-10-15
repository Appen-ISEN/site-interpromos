<?php

    /**
      * PHP version 8.1.11
      * 
      * @author Valentin Hervé <valentinherve60@gmail.com>
    */

    $sport = "";
    $phase = "poule";
    if(isset($_GET["sport"])){
        $sport = $_GET["sport"];
    }
    if(isset($_GET["phase"])){
        $phase = $_GET["phase"];
    }

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <title>
            <?php
                echo $sport." : ".$phase;
            ?>
        </title>
        <link href="public_html/css/style.css" rel="stylesheet">
        <link href="public_html/css/style_score.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container"></div>
        <img src="public_html/img/InterPromo.png">
        <input class="ButtonDayNight" type="image" src="public_html/img/DAYnNGH.png" onclick="switchDarkMode()" />

        <div id="content">
            <div class="horizontal_menu menu" id="sport_selection">
                <a href="index.php">Acceuil</a>
                <a href="score.php?sport=basket&phase=<?php echo $phase; ?>" <?php if($sport == "basket"){ echo "class=\"active\" ";} ?>>Basket</a>
                <a href="score.php?sport=handball&phase=<?php echo $phase; ?>" <?php if($sport == "handball"){ echo "class=\"active\" ";} ?>>Handball</a>
                <a href="score.php?sport=badminton&phase=<?php echo $phase; ?>" <?php if($sport == "badminton"){ echo "class=\"active\" ";} ?>>Badminton</a>
                <a href="score.php?sport=volley&phase=<?php echo $phase; ?>" <?php if($sport == "volley"){ echo "class=\"active\" ";} ?>>Volley</a>
                <a href="score.php?sport=futsal&phase=<?php echo $phase; ?>" <?php if($sport == "futsal"){ echo "class=\"active\" ";} ?>>Futsal</a>
            </div>
            <hr>
            <div class="horizontal_menu menu" id="phase">
                <a href="score.php?sport=<?php echo $sport; ?>&phase=poule" <?php if($phase == "poule"){ echo "class=\"active\" ";} ?>>Phases de poule</a>
                <a href="score.php?sport=<?php echo $sport; ?>&phase=arbre" <?php if($phase == "arbre"){ echo "class=\"active\" ";} ?>>Phases éliminatoires</a>
            </div>

            <div id="frame">
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
        </div>

        <script src="public_html/js/script.js"></script>
        <script src="public_html/js/script_score.js"></script>
    </body>
</html>