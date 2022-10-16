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

if (isset($_POST['delete_team'])) {
    $team_id = $_POST['team_id'];

    $db->deleteTeam($team_id);
}

$match_types = array(
    "0" => "Poule",
    "1" => "Finale",
    "2" => "Demi-finale",
    "3" => "Quart de finale",
    "4" => "Petite finale",
    "5" => "Huitième de finale",
    "6" => "Seizième de finale",
);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Interpromos - Administration</title>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
</head>

<body>
    <h1>Administration</h1>
    <a href="logout.php">Se déconnecter</a>
    <table id="table_teams" class="display">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->getTeams() as $team) { ?>
                <tr>
                    <td style="width: 40px;"><?php echo $team['id']; ?></td>
                    <td><?php echo $team['name']; ?></td>
                    <td style="width: 50px;">
                        <form method="POST">
                            <input type="hidden" name="team_id" value="<?php echo $team['id']; ?>" />
                            <input type="submit" name="delete_team" value="Supprimer" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <form method="POST">
        <input type="text" name="name" />
        <input type="submit" value="Ajouter Team" name="add_team" />
    </form>
    <table id="table_matches">
        <thead>
            <tr>
                <th>Id</th>
                <th>Type</th>
                <th>Sport</th>
                <th>Team A</th>
                <th>Team B</th>
                <th>Score A</th>
                <th>Score B</th>
                <th>Date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($db->getMatches() as $match) {
                $teams = json_decode($match['teams_id']);
                $scores = json_decode($match['scores']);
            ?>
                <tr>
                    <form method='POST'>
                        <td style="width: 40px;"><?php echo $match['id']; ?></td>
                        <td><?php echo $match_types[$match['type']]; ?></td>
                        <td><?php echo $match['sport_name']; ?></td>
                        <td><?php echo $db->getTeamName($teams[0]); ?></td>
                        <td><?php echo $db->getTeamName($teams[1]); ?></td>
                        <td style="width: 100px;"><input type="number" name="team1_score" value="<?php echo $scores[0]; ?>" style="width: 60px;" /></td>
                        <td style="width: 100px;"><input type="number" name="team2_score" value="<?php echo $scores[1]; ?>" style="width: 60px;" /></td>
                        <td><?php echo $match['date']; ?></td>
                        <td style="width: 50px;">
                            <input type="hidden" value="<?php echo $match['id']; ?>" name="match_id" />
                            <input type="hidden" value="<?php echo $teams[0]; ?>" name="team1_id" />
                            <input type="hidden" value="<?php echo $teams[1]; ?>" name="team2_id" />
                            <input type='submit' value='Modifier' name='edit_match' />
                        </td>
                    </form>
                    <td style="width: 50px;">
                        <form method="POST">
                            <input type="hidden" value="<?php echo $match['id']; ?>" name="match_id" />
                            <input type="submit" value="Supprimer" name="delete_match" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <form method="POST">
        <select name="type">
            <?php foreach ($match_types as $key => $value) {
                echo "<option value='$key'>$value</option>";
            } ?>
        </select>
        <select name="sport">
            <?php foreach ($sports as $sport) {
                echo "<option value='" . $sport['id'] . "'>" . $sport['name'] . "</option>";
            } ?>
        </select>
        <select name="team1">
            <?php foreach ($db->getTeams() as $team) {
                echo "<option value='" . $team['id'] . "'>" . $team['name'] . "</option>";
            } ?>
        </select>
        <select name="team2">
            <?php foreach ($db->getTeams() as $team) {
                echo "<option value='" . $team['id'] . "'>" . $team['name'] . "</option>";
            } ?>
        </select>
        <input type="datetime-local" name="datetime" />
        <input type="submit" value="Ajouter Match" name="add_match" />
    </form>
    </table>
    <script>
        $(document).ready(function() {
            $('#table_teams').DataTable();
            $('#table_matches').DataTable();
        });
    </script>
</body>

</html>