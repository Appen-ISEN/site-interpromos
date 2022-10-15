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
</body>

</html>