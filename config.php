<?php
session_start();

$is_logged_in = false;
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    $is_logged_in = true;
}

define('DB_PASS', 'F6AE_eo[L_-X*AUo');
define('DB_NAME', 'demo');

function get_connection()
{
    return new PDO(
        'mysql:host=localhost;dbname=' . DB_NAME . ';charset=utf8',
        DB_NAME,
        DB_PASS
    );
}

// Fake Store Database
//https://fakestoreapi.in/docs