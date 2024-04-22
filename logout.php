<?php
require_once ('config.php');

if ($is_logged_in) {
    session_destroy();
}

header('Location: login.php');

?>