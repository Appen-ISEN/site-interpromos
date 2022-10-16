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

$db->disconnectUser();

redirect('login.php');
