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
    $teams_poules = array();

    $matchs_poules = array();
    $matchs_eight = array();
    $matchs_quarters = array();
    $matchs_semis = array();
    $matchs_final = array();
    $matchs_little_final = array();
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
                        array_push($matchs_poules, $match);
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
                    default:
                        break;
                }
            }
        }
    }

    foreach($allteams as $team){
        $found = false;
        foreach($matchs_poules as $match){
            if(json_decode($match["teams_id"])[0] == $team["id"] || json_decode($match["teams_id"])[1] == $team["id"]){
                $found = true;
            }
        }
        if($found){
            array_push($teams_poules, $team);
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
                    <?php 
                        if($sport == "badminton"){
                            echo "<p id=\"group1-button\" class=\"bgcolor-btnprimary color-main active\">Éliminatoires, groupe 1</p>
                                <p id=\"group2-button\" class=\"bgcolor-btnprimary color-main\">Éliminatoires, groupe 2</p>
                                <p id=\"final-button\" class=\"bgcolor-btnprimary color-main\">Finales</p>";
                        }
                        else{
                            echo "<p id=\"group-phase-button\" class=\"bgcolor-btnprimary color-main active\">Phases de poule</p>
                                <p id=\"bracket-phase-button\" class=\"bgcolor-btnprimary color-main\">Phases éliminatoires</p>";
                        }
                    ?>
                </div>

                <?php
                    if($sport != "badminton"){
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
                    else{
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
                                echo "<div class=\"match";
                                if($i == 3){
                                    echo " no-margin";
                                }
                                echo "\">";
                                if($i != 1 && $i != 2){ // SOMETHING THAT WOULD BE USELESS IN THE FUTUR ---------------------------------
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
                                elseif(sizeof($matchs_quarters[$k-1]) >= $i - $del_elems + 1){
                                    $team1;
                                    $team2;
                                    foreach($allteams as $team){
                                        if($team["id"] == json_decode($matchs_quarters[$k-1][$i - $del_elems]["teams_id"])[0]){
                                            $team1 = $team;
                                        }
                                        if($team["id"] == json_decode($matchs_quarters[$k-1][$i - $del_elems]["teams_id"])[1]){
                                            $team2 = $team;
                                        }
                                    }


                                    echo "<div class=\"team";
                                    if(json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[0] > json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[1]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[0] < json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[1]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[0]."</p>";
                                    echo "</div>";

                                    echo "<div class=\"team";
                                    if(json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[1] > json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[0]){
                                        echo " winner";
                                    }
                                    elseif(json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[1] < json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[0]){
                                        echo " loser";
                                    }
                                    echo "\">";
                                    echo "<p class=\"team-name\">".$team2["name"]."</p>";
                                    echo "<p class=\"team-score\">".json_decode($matchs_quarters[$k-1][$i - $del_elems]["scores"])[1]."</p>";
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
                                    echo " gold-medal winner";
                                }
                                elseif(json_decode($matchs_final[$k-1][0]["scores"])[0] < json_decode($matchs_final[$k-1][0]["scores"])[1]){
                                    echo " silver-medal loser";
                                }
                                echo "\">";
                                echo "<p class=\"team-name\">".$team1["name"]."</p>";
                                echo "<p class=\"team-score\">".json_decode($matchs_final[$k-1][0]["scores"])[0]."</p>";
                                echo "</div>";

                                echo "<div class=\"team";
                                if(json_decode($matchs_final[$k-1][0]["scores"])[1] > json_decode($matchs_final[$k-1][0]["scores"])[0]){
                                    echo " gold-medal winner";
                                }
                                elseif(json_decode($matchs_final[$k-1][0]["scores"])[1] < json_decode($matchs_final[$k-1][0]["scores"])[0]){
                                    echo " silver-medal loser";
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
                ?>

                <div class="frame bgcolor-main" id="poules"> <!-- --------------------------------------------------------------------------------------------------- -->
                    <table class="color-main">
                        <thead>
                            <tr class="bgcolor-tableprimary">
                                <th class="bordercolor-main bold"></th>
                                <?php
                                    foreach ($teams_poules as $team) {
                                        echo "<th class=\"bordercolor-main\">".$team["name"]."</th>";
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $i = 0;
                                foreach ($teams_poules as $team) {
                                    $color = "primary";
                                    if($i%2 == 0){
                                        $color = "secondary";
                                    }
                                    echo "<tr class=\"bgcolor-table".$color."\">";
                                    echo "<td class=\"bordercolor-main bold\">".$team["name"]."</td>";
                                        foreach($teams_poules as $team2){
                                            echo "<td class=\"bordercolor-main\">";
                                            if($team2 != $team){
                                                $found = false;
                                                foreach($matchs_poules as $match){
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