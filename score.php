<!DOCTYPE html>
<html lang="fr">

    <head>
        <title>
            <?php
                $sport = "";
                if(isset($_GET["sport"])){
                    $sport = $_GET["sport"];
                }
                echo "Scores : ".$sport;
            ?>
        </title>
    </head>
    <body>
        <link href="public_html/css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <div class="container"></div>
        <img src="public_html/img/InterPromo.png">
        <input class="ButtonDayNight" type="image" src="public_html/img/DAYnNGH.png" onclick="myFunction()" />
        <div class="vertical_menu">
            <a href="index.php">Acceuil</a>
            <a href="score.php?sport=basket" <?php if($sport == "basket"){ echo "class=\"active\" ";} ?>>Basket</a>
            <a href="score.php?sport=handball" <?php if($sport == "handball"){ echo "class=\"active\" ";} ?>>Handball</a>
            <a href="score.php?sport=badminton" <?php if($sport == "badminton"){ echo "class=\"active\" ";} ?>>Badminton</a>
            <a href="score.php?sport=volley" <?php if($sport == "volley"){ echo "class=\"active\" ";} ?>>Volley</a>
            <a href="score.php?sport=futsal" <?php if($sport == "futsal"){ echo "class=\"active\" ";} ?>>Futsal</a>
        </div>

        <script>
            window.IsDark = 0;

            function myFunction() {
                document.body.classList.toggle("LightMode");
                if (window.IsDark == 0) {
                    document.querySelector('.vertical_menu').style.backgroundColor = 'rgb(211, 211, 211)';
                    var Choices = document.querySelectorAll('.vertical_menu a');
                    Choices.forEach(choice => {
                        choice.style.color = 'rgb(14, 14, 14)';
                    });
                    window.IsDark = 1;
                    console.log("White")
                } else {
                    document.querySelector('.vertical_menu').style.backgroundColor = 'rgb(44, 43, 43)';
                    var Choices = document.querySelectorAll('.vertical_menu a');
                    Choices.forEach(choice => {
                        choice.style.color = 'rgb(193, 193, 193)';
                    });
                    window.IsDark = 0;
                    console.log("Dark");
                }
            }
        </script>
    </body>
</html>