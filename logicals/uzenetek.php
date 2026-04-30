<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    header("Location: /belepes");
    exit();
}

$sql = "SELECT nev, email, uzenet, datum FROM uzenetek ORDER BY datum DESC";
$stmt = $db->query($sql);

?>