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
    $teams_poules1 = array();
    $teams_poules2 = array();

    $matchs_poules1 = array();
    $matchs_poules2 = array();
    $matchs_eight = array();
    $matchs_quarters = array();
    $matchs_semis = array();
    $matchs_final = array();
    $matchs_little_final = array();

    if($sport != "leaderboard"){
        if($sport == "badminton"){ 
            $matchs_eight1 = array();
            $matchs_eight2 = array();
            $matchs_quarters1 = array();
            $matchs_quarters2 = array();
            $matchs_semis1 = array();
            $matchs_semis2 = array();
            $matchs_final1 = array();
            $matchs_final2 = array();
            $matchs_final3 = array(); 
            foreach($db->getMatches() as $match){
                if(strtolower($match["sport_name"]) == strtolower($sport)."1"){
                    switch($match["type"]){
                        case 0:
                            break;
                        case 1:
                            array_push($matchs_final3, $match);
                            break;
                        case 2:
                            array_push($matchs_final1, $match);
                            break;
                        case 3:
                            array_push($matchs_semis1, $match);
                            break;
                        case 4:
                            array_push($matchs_little_final, $match);
                            break;
                        case 5:
                            array_push($matchs_quarters1, $match);
                            break;
                        case 6:
                            array_push($matchs_eight1, $match);
                            break;
                        default:
                            break;
                    }
                }
                if(strtolower($match["sport_name"]) == strtolower($sport)."2"){
                    switch($match["type"]){
                        case 0:
                            break;
                        case 1:
                            break;
                        case 2:
                            array_push($matchs_final2, $match);
                            break;
                        case 3:
                            array_push($matchs_semis2, $match);
                            break;
                        case 4:
                            break;
                        case 5:
                            array_push($matchs_quarters2, $match);
                            break;
                        case 6:
                            array_push($matchs_eight2, $match);
                            break;
                        default:
                            break;
                    }
                }
            }
            array_push($matchs_eight, $matchs_eight1);
            array_push($matchs_eight, $matchs_eight2);
            array_push($matchs_quarters, $matchs_quarters1);
            array_push($matchs_quarters, $matchs_quarters2);
            array_push($matchs_semis, $matchs_semis1);
            array_push($matchs_semis, $matchs_semis2);
            array_push($matchs_final, $matchs_final1);
            array_push($matchs_final, $matchs_final2);
            array_push($matchs_final, $matchs_final3);
        }
        else{
            foreach($db->getMatches() as $match){
                if(strtolower($match["sport_name"]) == strtolower($sport)){
                    switch($match["type"]){
                        case 0:
                            array_push($matchs_poules1, $match);
                            break;
                        case 1:
                            array_push($matchs_final, $match);
                            break;
                        case 2:
                            array_push($matchs_semis, $match);
                            break;
                        case 3:
                            array_push($matchs_quarters, $match);
                            break;
                        case 4:
                            array_push($matchs_little_final, $match);
                            break;
                        case 7:
                            array_push($matchs_poules2, $match);
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        foreach($allteams as $team){
            $found1 = false;
            $found2 = false;
            foreach($matchs_poules1 as $match){
                if(json_decode($match["teams_id"])[0] == $team["id"] || json_decode($match["teams_id"])[1] == $team["id"]){
                    $found1 = true;
                }
            }
            foreach($matchs_poules2 as $match){
                if(json_decode($match["teams_id"])[0] == $team["id"] || json_decode($match["teams_id"])[1] == $team["id"]){
                    $found2 = true;
                }
            }
            if($found1){
                array_push($teams_poules1, $team);
            }
            if($found2){
                array_push($teams_poules2, $team);
            }
        }
    }
    else{
        $leader = array(
            "A1" => array(2, 10, 10, 3, 1, 3, 1, 30, 4),
            "A2" => array(5, 7, 5, 5, 7, 7, 3, 39, 3),
            "A3" => array(7, 5, 7, 10, 5, 7, 2, 43, 1),
            "A4" => array(10, 3, 3, 7, 10, 10, 0, 43, 1),
            "A5" => array(1, 0, 0, 0, 0, 0, 0, 1, 6),
            "Permanents" => array(0, 0, 0, 0, 0, 2, 0, 2, 5)
        );
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
                    <a href="score.php?sport=leaderboard" class="bold color-main<?php if($sport == "leaderboard"){ echo " active";} else{ echo " bgcolor-btnprimary";} ?>">Classements</a>
                </div>
                <hr>
                <div class="horizontal_menu menu" id="phase">
                    <?php 
                        if($sport == "badminton"){
                            echo "<p id=\"group1-button\" class=\"bgcolor-btnprimary color-main active\">Éliminatoires, groupe 1</p>
                                <p id=\"group2-button\" class=\"bgcolor-btnprimary color-main\">Éliminatoires, groupe 2</p>
                                <p id=\"final-button\" class=\"bgcolor-btnprimary color-main\">Finales</p>";
                        }
                        elseif($sport != "leaderboard"){
                            echo "<p id=\"group-phase-button\" class=\"bgcolor-btnprimary color-main active\">Phases de poule</p>
                                <p id=\"bracket-phase-button\" class=\"bgcolor-btnprimary color-main\">Phases éliminatoires</p>";
                        }
                    ?>
                </div>

                <?php
                    if($sport != "badminton" && $sport != "leaderboard"){
                ?>

                <div class="frame bracket" id="bracket"> <!-- --------------------------------------------------------------------------------------------------- -->
                    
                    <?php
                        if(sizeof($matchs_quarters) > 0 || sizeof($matchs_final) == 0 && sizeof($matchs_semis) == 0 && sizeof($matchs_little_final) == 0){
                    ?>

                    <div class="quarter-finals round">
                        <h1 class="round-title">Quarts de finale</h1>

                        <?php
                            for($i = 0; $i < 4; $i++){
                                echo "<div class=\"match";
                                if($i == 3){
                                    echo " no-margin";
                                }
                                echo "\">";
                                if(sizeof($matchs_quarters) >= $i + 1){
                                    $team1;
                                    $team2;
                                    foreach($allteams as $team){
                                        if($team["id"] == json_decode($matchs_quarters[$i]["teams_id"])[0]){
                                            $team1 = $team;
                                        }
                                        if($team["id"] == json_decode($matchs_quarters[$i]["teams_id"])[1]){
                                            $team2 = $team;
                                        }
                                    }


                                    echo "<div class=\"team";
                                    if(json_decode($matchs_quarters[$i]["scores"])[0] > json_decode($matchs_quarters[$i]["scores"])[1]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_quarters[$i]["scores"])[0] < json_decode($matchs_quarters[$i]["scores"])[1]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_quarters[$i]["scores"])[0]."</p>";
                                    echo "</div>";

                                    echo "<div class=\"team";
                                    if(json_decode($matchs_quarters[$i]["scores"])[1] > json_decode($matchs_quarters[$i]["scores"])[0]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_quarters[$i]["scores"])[1] < json_decode($matchs_quarters[$i]["scores"])[0]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_quarters[$i]["scores"])[1]."</p>";
                                    echo "</div>";
                                }
                                else{
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        ?>
                    </div>

                    <div class="braces">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace quarters-brace">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace quarters-brace no-margin">
                    </div>

                    <?php } ?>

                    <div class="semi-finals round">
                        <h1 class="round-title">Demi-finales</h1>
                        
                        <?php
                            for($i = 0; $i < 2; $i++){
                                echo "<div class=\"match";
                                if($i == 1){
                                    echo " no-margin";
                                }
                                echo "\">";
                                if(sizeof($matchs_semis) >= $i + 1){
                                    $team1;
                                    $team2;
                                    foreach($allteams as $team){
                                        if($team["id"] == json_decode($matchs_semis[$i]["teams_id"])[0]){
                                            $team1 = $team;
                                        }
                                        if($team["id"] == json_decode($matchs_semis[$i]["teams_id"])[1]){
                                            $team2 = $team;
                                        }
                                    }


                                    echo "<div class=\"team";
                                    if(json_decode($matchs_semis[$i]["scores"])[0] > json_decode($matchs_semis[$i]["scores"])[1]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_semis[$i]["scores"])[0] < json_decode($matchs_semis[$i]["scores"])[1]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_semis[$i]["scores"])[0]."</p>";
                                    echo "</div>";

                                    echo "<div class=\"team";
                                    if(json_decode($matchs_semis[$i]["scores"])[1] > json_decode($matchs_semis[$i]["scores"])[0]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_semis[$i]["scores"])[1] < json_decode($matchs_semis[$i]["scores"])[0]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_semis[$i]["scores"])[1]."</p>";
                                    echo "</div>";
                                }
                                else{
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        ?>

                    </div>

                    <div class="braces">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace semi-brace">
                    </div>

                    <div class="final round">
                        <h1 class="round-title">Finale</h1>
                        <?php
                            echo "<div class=\"match\">";
                            if(sizeof($matchs_final) >= 1){
                                $team1;
                                $team2;
                                foreach($allteams as $team){
                                    if($team["id"] == json_decode($matchs_final[0]["teams_id"])[0]){
                                        $team1 = $team;
                                    }
                                    if($team["id"] == json_decode($matchs_final[0]["teams_id"])[1]){
                                        $team2 = $team;
                                    }
                                }


                                echo "<div class=\"team";
                                if(json_decode($matchs_final[0]["scores"])[0] > json_decode($matchs_final[0]["scores"])[1]){
                                    echo " gold-medal winner";
                                }
                                elseif(json_decode($matchs_final[0]["scores"])[0] < json_decode($matchs_final[0]["scores"])[1]){
                                    echo " silver-medal loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_final[0]["scores"])[0]."</p>";
                                echo "</div>";

                                echo "<div class=\"team";
                                if(json_decode($matchs_final[0]["scores"])[1] > json_decode($matchs_final[0]["scores"])[0]){
                                    echo " gold-medal winner";
                                }
                                elseif(json_decode($matchs_final[0]["scores"])[1] < json_decode($matchs_final[0]["scores"])[0]){
                                    echo " silver-medal loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_final[0]["scores"])[1]."</p>";
                                echo "</div>";
                            }
                            else{
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                            }
                            echo "</div>";
                        ?>
                    </div>

                    <div class="braces"><p> </p>
                    </div>

                    <div class="bronze-medal-game round">
                        <h1 class="round-title">Petite finale</h1>
                        <?php
                            echo "<div class=\"match\">";
                            if(sizeof($matchs_little_final) >= 1){
                                $team1;
                                $team2;
                                foreach($allteams as $team){
                                    if($team["id"] == json_decode($matchs_little_final[0]["teams_id"])[0]){
                                        $team1 = $team;
                                    }
                                    if($team["id"] == json_decode($matchs_little_final[0]["teams_id"])[1]){
                                        $team2 = $team;
                                    }
                                }


                                echo "<div class=\"team";
                                if(json_decode($matchs_little_final[0]["scores"])[0] > json_decode($matchs_little_final[0]["scores"])[1]){
                                    echo " bronze-medal winner";
                                }
                                elseif(json_decode($matchs_little_final[0]["scores"])[0] < json_decode($matchs_little_final[0]["scores"])[1]){
                                    echo " loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_little_final[0]["scores"])[0]."</p>";
                                echo "</div>";

                                echo "<div class=\"team";
                                if(json_decode($matchs_little_final[0]["scores"])[1] > json_decode($matchs_little_final[0]["scores"])[0]){
                                    echo " bronze-medal winner";
                                }
                                elseif(json_decode($matchs_little_final[0]["scores"])[1] < json_decode($matchs_little_final[0]["scores"])[0]){
                                    echo " loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_little_final[0]["scores"])[1]."</p>";
                                echo "</div>";
                            }
                            else{
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                            }
                            echo "</div>";
                        ?>
                    </div>
                </div>

                <?php
                    }
                    elseif($sport != "leaderboard"){
                        for($k = 1; $k < 3; $k++){
                ?>

                <div class="frame bracket" id="bracket-16-<?php echo $k; ?>"> <!-- --------------------------------------------------------------------------------------------------- -->

                    <div class="eight-finals round">
                        <h1 class="round-title">16èmes de finale</h1>

                        <?php
                            $del_elems = 0;
                            for($i = 0; $i < 8; $i++){
                                echo "<div class=\"match";
                                if($i == 7){
                                    echo " no-margin";
                                }
                                if($i == 0){
                                    echo " margintop";
                                }
                                echo "\">";
                                if($i != 1 && $i != 6){
                                    $del_elems++;
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                }
                                elseif(sizeof($matchs_eight[$k-1]) >= $i - $del_elems + 1){
                                    $team1;
                                    $team2;
                                    foreach($allteams as $team){
                                        if($team["id"] == json_decode($matchs_eight[$k-1][$i - $del_elems]["teams_id"])[0]){
                                            $team1 = $team;
                                        }
                                        if($team["id"] == json_decode($matchs_eight[$k-1][$i - $del_elems]["teams_id"])[1]){
                                            $team2 = $team;
                                        }
                                    }


                                    echo "<div class=\"team";
                                    if(json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[0] > json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[1]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[0] < json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[1]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[0]."</p>";
                                    echo "</div>";

                                    echo "<div class=\"team";
                                    if(json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[1] > json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[0]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[1] < json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[0]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_eight[$k-1][$i - $del_elems]["scores"])[1]."</p>";
                                    echo "</div>";
                                }
                                else{
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        ?>
                    </div>

                    <div class="braces">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace eight-brace marg-bonus">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace eight-brace">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace eight-brace">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace eight-brace no-margin">
                    </div>

                    <div class="quarter-finals round">
                        <h1 class="round-title">8èmes de finale</h1>

                        <?php
                            $del_elems = 0; // SOMETHING THAT WOULD BE USELESS IN THE FUTUR <--------------------------------------------
                            for($i = 0; $i < 4; $i++){
                                $jj = 0;
                                echo "<div class=\"match";
                                if($i == 3){
                                    echo " no-margin";
                                }
                                echo "\">";
                                switch($i){
                                    case 0:
                                        $jj = 2;
                                        break;
                                    case 1:
                                        $jj = 0;
                                        break;
                                    case 2:
                                        $jj = 1;
                                        break;
                                    case 3:
                                        $jj = 3;
                                        break;
                                }
                                if(sizeof($matchs_quarters[$k-1]) >= $jj + 1){
                                    $team1;
                                    $team2;
                                    foreach($allteams as $team){
                                        if($team["id"] == json_decode($matchs_quarters[$k-1][$jj]["teams_id"])[0]){
                                            $team1 = $team;
                                        }
                                        if($team["id"] == json_decode($matchs_quarters[$k-1][$jj]["teams_id"])[1]){
                                            $team2 = $team;
                                        }
                                    }


                                    echo "<div class=\"team";
                                    if(json_decode($matchs_quarters[$k-1][$jj]["scores"])[0] > json_decode($matchs_quarters[$k-1][$jj]["scores"])[1]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_quarters[$k-1][$jj]["scores"])[0] < json_decode($matchs_quarters[$k-1][$jj]["scores"])[1]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_quarters[$k-1][$jj]["scores"])[0]."</p>";
                                    echo "</div>";

                                    echo "<div class=\"team";
                                    if(json_decode($matchs_quarters[$k-1][$jj]["scores"])[1] > json_decode($matchs_quarters[$k-1][$jj]["scores"])[0]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_quarters[$k-1][$jj]["scores"])[1] < json_decode($matchs_quarters[$k-1][$jj]["scores"])[0]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_quarters[$k-1][$jj]["scores"])[1]."</p>";
                                    echo "</div>";
                                }
                                else{
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        ?>
                    </div>

                    <div class="braces">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace quarters-brace">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace quarters-brace no-margin">
                    </div>

                    <div class="semi-finals round">
                        <h1 class="round-title">Quarts de finale</h1>
                        
                        <?php
                            for($i = 0; $i < 2; $i++){
                                echo "<div class=\"match";
                                if($i == 1){
                                    echo " no-margin";
                                }
                                echo "\">";
                                if(sizeof($matchs_semis[$k-1]) >= $i + 1){
                                    $team1;
                                    $team2;
                                    foreach($allteams as $team){
                                        if($team["id"] == json_decode($matchs_semis[$k-1][$i]["teams_id"])[0]){
                                            $team1 = $team;
                                        }
                                        if($team["id"] == json_decode($matchs_semis[$k-1][$i]["teams_id"])[1]){
                                            $team2 = $team;
                                        }
                                    }


                                    echo "<div class=\"team";
                                    if(json_decode($matchs_semis[$k-1][$i]["scores"])[0] > json_decode($matchs_semis[$k-1][$i]["scores"])[1]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_semis[$k-1][$i]["scores"])[0] < json_decode($matchs_semis[$k-1][$i]["scores"])[1]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_semis[$k-1][$i]["scores"])[0]."</p>";
                                    echo "</div>";

                                    echo "<div class=\"team";
                                    if(json_decode($matchs_semis[$k-1][$i]["scores"])[1] > json_decode($matchs_semis[$k-1][$i]["scores"])[0]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_semis[$k-1][$i]["scores"])[1] < json_decode($matchs_semis[$k-1][$i]["scores"])[0]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_semis[$k-1][$i]["scores"])[1]."</p>";
                                    echo "</div>";
                                }
                                else{
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                    echo "<div class=\"team\">";
                                    echo "<p class=\"team-name\">-</p>";
                                    echo "<p class=\"team-score\">-</p>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        ?>

                    </div>

                    <div class="braces">
                        <img src="public_html/img/brace.png" alt="Brace" class="brace semi-brace">
                    </div>

                    <div class="final round">
                        <h1 class="round-title">Demi-finales</h1>
                        <?php
                            echo "<div class=\"match\">";
                            if(sizeof($matchs_final[$k-1]) >= 1){
                                $team1;
                                $team2;
                                foreach($allteams as $team){
                                    if($team["id"] == json_decode($matchs_final[$k-1][0]["teams_id"])[0]){
                                        $team1 = $team;
                                    }
                                    if($team["id"] == json_decode($matchs_final[$k-1][0]["teams_id"])[1]){
                                        $team2 = $team;
                                    }
                                }


                                echo "<div class=\"team";
                                if(json_decode($matchs_final[$k-1][0]["scores"])[0] > json_decode($matchs_final[$k-1][0]["scores"])[1]){
                                    echo " winner";
                                }
                                elseif(json_decode($matchs_final[$k-1][0]["scores"])[0] < json_decode($matchs_final[$k-1][0]["scores"])[1]){
                                    echo " loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_final[$k-1][0]["scores"])[0]."</p>";
                                echo "</div>";

                                echo "<div class=\"team";
                                if(json_decode($matchs_final[$k-1][0]["scores"])[1] > json_decode($matchs_final[$k-1][0]["scores"])[0]){
                                    echo " winner";
                                }
                                elseif(json_decode($matchs_final[$k-1][0]["scores"])[1] < json_decode($matchs_final[$k-1][0]["scores"])[0]){
                                    echo " loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_final[$k-1][0]["scores"])[1]."</p>";
                                echo "</div>";
                            }
                            else{
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                            }
                            echo "</div>";
                        ?>
                    </div>
                </div>

                <?php
                    }       
                ?>

                <div class="frame bracket" id="bracket-finals"> <!-- --------------------------------------------------------------------------------------------------- -->

                    <div class="final round">
                        <h1 class="round-title">Finale</h1>
                        <?php
                            echo "<div class=\"match\">";
                            if(sizeof($matchs_final[2]) >= 1){
                                $team1;
                                $team2;
                                foreach($allteams as $team){
                                    if($team["id"] == json_decode($matchs_final[2][0]["teams_id"])[0]){
                                        $team1 = $team;
                                    }
                                    if($team["id"] == json_decode($matchs_final[2][0]["teams_id"])[1]){
                                        $team2 = $team;
                                    }
                                }


                                echo "<div class=\"team";
                                if(json_decode($matchs_final[2][0]["scores"])[0] > json_decode($matchs_final[2][0]["scores"])[1]){
                                    echo " gold-medal winner";
                                }
                                elseif(json_decode($matchs_final[2][0]["scores"])[0] < json_decode($matchs_final[2][0]["scores"])[1]){
                                    echo " silver-medal loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_final[2][0]["scores"])[0]."</p>";
                                echo "</div>";

                                echo "<div class=\"team";
                                if(json_decode($matchs_final[2][0]["scores"])[1] > json_decode($matchs_final[2][0]["scores"])[0]){
                                    echo " gold-medal winner";
                                }
                                elseif(json_decode($matchs_final[2][0]["scores"])[1] < json_decode($matchs_final[2][0]["scores"])[0]){
                                    echo " silver-medal loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_final[2][0]["scores"])[1]."</p>";
                                echo "</div>";
                            }
                            else{
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                            }
                            echo "</div>";
                        ?>
                    </div>

                    <div class="braces"><p> </p>
                    </div>

                    <div class="bronze-medal-game round">
                        <h1 class="round-title">Petite finale</h1>
                        <?php
                            echo "<div class=\"match\">";
                            if(sizeof($matchs_little_final) >= 1){
                                $team1;
                                $team2;
                                foreach($allteams as $team){
                                    if($team["id"] == json_decode($matchs_little_final[0]["teams_id"])[0]){
                                        $team1 = $team;
                                    }
                                    if($team["id"] == json_decode($matchs_little_final[0]["teams_id"])[1]){
                                        $team2 = $team;
                                    }
                                }


                                echo "<div class=\"team";
                                if(json_decode($matchs_little_final[0]["scores"])[0] > json_decode($matchs_little_final[0]["scores"])[1]){
                                    echo " bronze-medal winner";
                                }
                                elseif(json_decode($matchs_little_final[0]["scores"])[0] < json_decode($matchs_little_final[0]["scores"])[1]){
                                    echo " loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_little_final[0]["scores"])[0]."</p>";
                                echo "</div>";

                                echo "<div class=\"team";
                                if(json_decode($matchs_little_final[0]["scores"])[1] > json_decode($matchs_little_final[0]["scores"])[0]){
                                    echo " bronze-medal winner";
                                }
                                elseif(json_decode($matchs_little_final[0]["scores"])[1] < json_decode($matchs_little_final[0]["scores"])[0]){
                                    echo " loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_little_final[0]["scores"])[1]."</p>";
                                echo "</div>";
                            }
                            else{
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                                echo "<div class=\"team\">";
                                echo "<p class=\"team-name\">-</p>";
                                echo "<p class=\"team-score\">-</p>";
                                echo "</div>";
                            }
                            echo "</div>";
                        ?>
                    </div>
                </div>

                <?php
                    }
                    if($sport != "leaderboard"){
                ?>

                <div class="frame bgcolor-main" id="poules"> <!-- --------------------------------------------------------------------------------------------------- -->
                    <table class="color-main">
                        <thead>
                            <tr class="bgcolor-tableprimary">
                                <th class="bordercolor-main bold">Poule A</th>
                                <?php
                                    foreach ($teams_poules1 as $team) {
                                        echo "<th class=\"bordercolor-main\">".$team["name"]."</th>";
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $i = 0;
                                foreach ($teams_poules1 as $team) {
                                    $color = "primary";
                                    if($i%2 == 0){
                                        $color = "secondary";
                                    }
                                    echo "<tr class=\"bgcolor-table".$color."\">";
                                    echo "<td class=\"bordercolor-main bold\">".$team["name"]."</td>";
                                        foreach($teams_poules1 as $team2){
                                            echo "<td class=\"bordercolor-main\">";
                                            if($team2 != $team){
                                                $found = false;
                                                foreach($matchs_poules1 as $match){
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

                    <table class="color-main">
                        <thead>
                            <tr class="bgcolor-tableprimary">
                                <th class="bordercolor-main bold">Poule B</th>
                                <?php
                                    foreach ($teams_poules2 as $team) {
                                        echo "<th class=\"bordercolor-main\">".$team["name"]."</th>";
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $i = 0;
                                foreach ($teams_poules2 as $team) {
                                    $color = "primary";
                                    if($i%2 == 0){
                                        $color = "secondary";
                                    }
                                    echo "<tr class=\"bgcolor-table".$color."\">";
                                    echo "<td class=\"bordercolor-main bold\">".$team["name"]."</td>";
                                        foreach($teams_poules2 as $team2){
                                            echo "<td class=\"bordercolor-main\">";
                                            if($team2 != $team){
                                                $found = false;
                                                foreach($matchs_poules2 as $match){
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

                <?php
                    }
                    else{
                ?>

                <div class="frame bgcolor-main" id="poules">
                    <table class="color-main">
                        <thead>
                            <tr class="bgcolor-tableprimary">
                                <th class="bordercolor-main bold"></th>
                                <th class="bordercolor-main bold">Badminton</th>
                                <th class="bordercolor-main bold">Futsal</th>
                                <th class="bordercolor-main bold">Basket</th>
                                <th class="bordercolor-main bold">Handball</th>
                                <th class="bordercolor-main bold">Volley</th>
                                <th class="bordercolor-main bold">Bear & Run</th>
                                <th class="bordercolor-main bold">Spectateurs</th>
                                <th class="bordercolor-main bold">TOTAL</th>
                                <th class="bordercolor-main bolder color-red">Rang</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $i = 0;
                                foreach($leader as $key => $values){
                                    if($i % 2 == 0){
                                        echo "<tr class=\"bgcolor-tablesecondary\">";
                                    }
                                    else{
                                        echo "<tr class=\"bgcolor-tableprimary\">";
                                    }

                                    echo "<th class=\"bordercolor-main bold\">".$key."</th>";
                                    
                                    $j = 0;
                                    foreach($values as $val){
                                        if($j != 8){
                                            echo "<td class=\"bordercolor-main\">".$val."</td>";
                                        }
                                        else{
                                            $rank = "";
                                            switch($val){
                                                case 1:
                                                    $rank = " gold-leader";
                                                    break;
                                                case 2:
                                                    $rank = " silver-leader";
                                                    break;
                                                case 3:
                                                    $rank = " bronze-leader";
                                                    break;
                                                default:
                                                    break;
                                            }
                                            echo "<td class=\"bordercolor-main bold".$rank."\">#".$val."</td>";
                                        }
                                        $j++;
                                    }
                                    echo "</tr>";
                                    $i++;
                                }
                            ?>

                        </tbody>
                    </table>
                </div>

                <?php
                    }
                ?>

            </div>
        </div>
        <input class="ButtonDayNight" type="image" src="public_html/img/DAYnNGH.png" onclick="switchDarkMode()" />

        <script src="public_html/js/script.js"></script>
        <script src="public_html/js/script_score.js"></script>
    </body>
</html>