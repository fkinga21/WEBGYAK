<?php
ob_start();
session_start();

// 1. Csak bejelentkezett felhasználó tölthet fel
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php?oldal=belepes");
    exit();
}

$cél_mappa = "../images/galeria/";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["feltoltott_kep"])) {
    
    // Fájlnév tisztítása és egyedivé tétele időbélyeggel
    $fájlnév = time() . "_" . basename($_FILES["feltoltott_kep"]["name"]);
    $cél_fájl = $cél_mappa . $fájlnév;
    
    // Fájltípus ellenőrzése
    $kiterjesztés = strtolower(pathinfo($cél_fájl, PATHINFO_EXTENSION));
    $engedelyezett_típusok = ["jpg", "jpeg", "png", "gif"];

    if (in_array($kiterjesztés, $engedelyezett_típusok)) {
        // Fájl mozgatása a mappába
        if (move_uploaded_file($_FILES["feltoltott_kep"]["tmp_name"], $cél_fájl)) {
    // SIKER: Munkamenetbe mentjük az üzenetet
    $_SESSION['uzenet'] = 'Sikeres feltöltés!';
    header("Location: http://cukorweb1.nhely.hu/kepek");
    exit();
    } else {
    // HIBA: Munkamenetbe mentjük az üzenetet
    $_SESSION['uzenet'] = 'Hiba történt a feltöltés során!';
    header("Location: http://cukorweb1.nhely.hu/kepek");
    exit();
}
    }
}
