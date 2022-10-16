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

if (isset($_POST['edit_match'])) {
    $match_id = $_POST['match_id'];
    $team1_id = $_POST['team1_id'];
    $team2_id = $_POST['team2_id'];
    $team1_score = $_POST['team1_score'];
    $team2_score = $_POST['team2_score'];

    $db->modifyScore($team1_score, $team1_id, $match_id);
    $db->modifyScore($team2_score, $team2_id, $match_id);
}

if (isset($_POST['delete_match'])) {
    $match_id = $_POST['match_id'];

    $db->deleteMatch($match_id);
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
                    <?php foreach ($db->getMatches() as $match) {
                        $teams = json_decode($match['teams_id']);
                        $scores = json_decode($match['scores']);
                    ?>
                        <tr>
                            <form method='POST'>
                                <td><?php echo $match['id']; ?></td>
                                <td><?php echo $match_types[$match['type']]; ?></td>
                                <td><?php echo $match['sport_name']; ?></td>
                                <td><?php echo $db->getTeamName($teams[0]); ?></td>
                                <td><?php echo $db->getTeamName($teams[1]); ?></td>
                                <td><input type="number" name="team1_score" value="<?php echo $scores[0]; ?>" /></td>
                                <td><input type="number" name="team2_score" value="<?php echo $scores[1]; ?>" /></td>
                                <td><?php echo $match['date']; ?></td>
                                <td>
                                    <input type="hidden" value="<?php echo $match['id']; ?>" name="match_id" />
                                    <input type="hidden" value="<?php echo $teams[0]; ?>" name="team1_id" />
                                    <input type="hidden" value="<?php echo $teams[1]; ?>" name="team2_id" />
                                    <input type='submit' value='Modifier' name='edit_match' />
                                </td>
                            </form>
                            <td>
                                <form method="POST">
                                    <input type="hidden" value="<?php echo $match['id']; ?>" name="match_id" />
                                    <input type="submit" value="Supprimer" name="delete_match" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <form method="POST">
                            <td></td>
                            <td>
                                <select name="type">
                                    <?php foreach ($match_types as $key => $value) {
                                        echo "<option value='$key'>$value</option>";
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <select name="sport">
                                    <?php foreach ($sports as $sport) {
                                        echo "<option value='" . $sport['id'] . "'>" . $sport['name'] . "</option>";
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <select name="team1">
                                    <?php foreach ($db->getTeams() as $team) {
                                        echo "<option value='" . $team['id'] . "'>" . $team['name'] . "</option>";
                                    } ?>
                                </select>
                            </td>
                            <td>
                                <select name="team2">
                                    <?php foreach ($db->getTeams() as $team) {
                                        echo "<option value='" . $team['id'] . "'>" . $team['name'] . "</option>";
                                    } ?>
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td><input type="datetime-local" name="datetime" /></td>
                            <td><input type="submit" value="Ajouter Match" name="add_match" /></td>
                        </form>

                        </form>
                    </tr>
                </table>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>