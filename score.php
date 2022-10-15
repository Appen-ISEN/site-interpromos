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

            </div>
        </div>

        <script src="public_html/js/script.js"></script>
        <script src="public_html/js/script_score.js"></script>
    </body>
</html>