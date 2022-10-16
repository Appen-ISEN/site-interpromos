<?php

    /**
      * PHP version 8.1.11
      * 
      * @author Valentin Hervé <valentinherve60@gmail.com>
    */

    require_once 'resources/config.php';
    require_once 'resources/database.php';

    $db = new Database();
    

    $sport = "";
    if(isset($_GET["sport"])){
        $sport = $_GET["sport"];
    }

    $allteams = $db->getTeams();
    $teams = array();

    $matchs = array();
    foreach($db->getMatches() as $match){
        if($match["type"] == 0 && strtolower($match["sport_name"]) == strtolower($sport)){
            array_push($matchs, $match);
        }
    }

    foreach($allteams as $team){
        $found = false;
        foreach($matchs as $match){
            if(json_decode($match["teams_id"])[0] == $team["id"] || json_decode($match["teams_id"])[1] == $team["id"]){
                $found = true;
            }
        }
        if($found){
            array_push($teams, $team);
        }
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
                                <th class="bordercolor-main bold"></th>
                                <?php
                                    foreach ($teams as $team) {
                                        echo "<th class=\"bordercolor-main\">".$team["name"]."</th>";
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $i = 0;
                                foreach ($teams as $team) {
                                    $color = "primary";
                                    if($i%2 == 0){
                                        $color = "secondary";
                                    }
                                    echo "<tr class=\"bgcolor-table".$color."\">";
                                    echo "<td class=\"bordercolor-main bold\">".$team["name"]."</td>";
                                        foreach($teams as $team2){
                                            echo "<td class=\"bordercolor-main\">";
                                            if($team2 != $team){
                                                $found = false;
                                                foreach($matchs as $match){
                                                    if(json_decode($match["teams_id"])[1] == $team["id"] && json_decode($match["teams_id"])[0] == $team2["id"]){
                                                        echo json_decode($match["scores"])[1]." - ".json_decode($match["scores"])[0];
                                                        $found = true;
                                                    }
                                                    if(json_decode($match["teams_id"])[0] == $team["id"] && json_decode($match["teams_id"])[1] == $team2["id"]){
                                                        echo json_decode($match["scores"])[0]." - ".json_decode($match["scores"])[1];
                                                        $found = true;
                                                    }
                                                }
                                                if(!$found){
                                                    echo "-";
                                                }
                                            }
                                            else{
                                                echo "X";
                                            }
                                            echo "</td>";
                                        }
                                    echo "</tr>";
                                    $i++;
                                }
                            ?>
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