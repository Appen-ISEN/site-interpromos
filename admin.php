<?php

/**
 * PHP version 8.1.11
 * 
 * @author Youn Mélois <youn@melois.dev>
 */

require_once 'resources/config.php';
require_once 'resources/database.php';
require_once LIBRARY_PATH . '/redirect.php';
require_once LIBRARY_PATH . '/exceptions.php';

$db = new Database();
$sports = $db->getSports();

// redirect to the login page if the user is not logged in
if (isset($_COOKIE[ACCESS_TOKEN_NAME])) {
    $access_token = $_COOKIE[ACCESS_TOKEN_NAME];
    $success = $db->verifyUserAccessToken($access_token);
    if (!$success) {
        redirect('login.php');
    }
} else {
    redirect('login.php');
}

if (isset($_POST['add_team'])) {
    $name = $_POST['name'];

    if (strlen($name) > 0) {
        $db->createTeam($name);
    }
}

if (isset($_POST['add_match'])) {
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $sport_id = $_POST['sport'];
    $type = $_POST['type'];
    $date = $_POST['datetime'];

    if (strlen($date) > 0) {
        $db->createMatch($team1, $team2, $sport_id, $type, $date);
    }
}

$match_types = array(
    "0" => "Poule",
    "1" => "Finale",
    "2" => "Demi-finale",
    "3" => "Quart de finale",
    "4" => "Huitième de finale"
);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Interpromos - Administration</title>
</head>

<body>
    <h1>Administration</h1>
    <a href="logout.php">Se déconnecter</a>
    <table>
        <tr>
            <th>Teams</th>
            <th>Matches</th>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                    </tr>
                    <?php
                    foreach ($db->getTeams() as $team) {
                        echo "<tr>";
                        echo "<td>" . $team['id'] . "</td>";
                        echo "<td>" . $team['name'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <form method="POST">
                    <input type="text" name="name" />
                    <input type="submit" value="Ajouter Team" name="add_team" />
                </form>
            </td>
            <td>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Type</th>
                        <th>Sport</th>
                        <th>Team A</th>
                        <th>Team B</th>
                        <th>Score A</th>
                        <th>Score B</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    foreach ($db->getMatches() as $match) {
                        echo "<tr>";
                        echo "<td>" . $match['id'] . "</td>";
                        echo "<td>" . $match_types[$match['type']] . "</td>";
                        echo "<td>" . $match['sport_name'] . "</td>";
                        $teams = json_decode($match['teams_id']);
                        echo "<td>" . $db->getTeamName($teams[0]) . "</td>";
                        echo "<td>" . $db->getTeamName($teams[1]) . "</td>";
                        $scores = json_decode($match['scores']);
                        echo "<td>" . $scores[0] . "</td>";
                        echo "<td>" . $scores[1] . "</td>";
                        echo "<td>" . $match['date'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <form method="POST">
                    <select name="team1">
                        <?php
                        foreach ($db->getTeams() as $team) {
                            echo "<option value=\"" . $team['id'] . "\">" . $team['name'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="team2">
                        <?php
                        foreach ($db->getTeams() as $team) {
                            echo "<option value=\"" . $team['id'] . "\">" . $team['name'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="sport">
                        <?php
                        foreach ($sports as $sport) {
                            echo "<option value=\"" . $sport['id'] . "\">" . $sport['name'] . "</option>";
                        }
                        ?>
                    </select>
                    <select name="type">
                        <!-- 0: pool, 1: final, 2: semi-final, 3: quarter-final, 4: eighth-final -->
                        <option value="0">Poule</option>
                        <option value="1">Finale</option>
                        <option value="2">Demi-finale</option>
                        <option value="3">Quart de finale</option>
                        <option value="4">Huitième de finale</option>
                    </select>
                    <input type="datetime-local" name="datetime" />
                    <input type="submit" value="Ajouter Match" name="add_match" />
                </form>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>