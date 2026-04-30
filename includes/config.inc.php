<?php
// Adatbázis kapcsolathoz szükséges adatok
$host = 'mysql.omega'; // adatbázis szerver címe
$db   = 'cukorweb1'; // adatbázis neve
$user = 'cukorweb1'; // felhasználónév
$pass = 'sutike21*'; // jelszó

try {
    $db = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	// Ha nem sikerül a kapcsolódás, leállítjuk a programot és kiírjuk a hibát
    die('Hiba: ' . $e->getMessage());
}
$ablakcim = array(
    'cim' => 'CUKI',
);
// Hibakezelés beállítása: kivételt dob hiba esetén
$fejlec = array(
    'kepforras' => 'sutikelogo.png', // logó képfájl
    'kepalt' => 'logo',  // kép alt attribútuma
	'cim' => 'Cukrászda Adminisztráció', // fő cím
	'motto' => '' // opcionális mottó
);
// Lábléc adatai
$lablec = array(
    'copyright' => 'Copyright '.date("Y").'.', // aktuális év automatikusan
    'ceg' => 'Cukrászda Adminisztráció | Készítette: Baricza Lili Viktória(fagcko) & Fődi Kinga(ew67ro)'
);
// Oldalak konfigurációja
$oldalak = array(
	'/' => array('fajl' => 'cimlap', 'szoveg' => 'Főoldal', 'menun' => array(1,1)),
	'kepek' => array('fajl' => 'kepek', 'szoveg' => 'Képek', 'menun' => array(1,1)),
	'kapcsolat' => array('fajl' => 'kapcsolat', 'szoveg' => 'Kapcsolat', 'menun' => array(1,1)),
    'uzenetek' => array('fajl' => 'uzenetek', 'szoveg' => 'Üzenetek', 'menun' => array(0,1)),
	'crud' => array('fajl' => 'crud', 'szoveg' => 'CRUD', 'menun' => array(1,1)),
    'belepes' => array('fajl' => 'belepes', 'szoveg' => 'Belépés', 'menun' => array(1,0)),
    'kilepes' => array('fajl' => 'kilepes', 'szoveg' => 'Kilépés', 'menun' => array(0,1)),
    'belep' => array('fajl' => 'belep', 'szoveg' => '', 'menun' => array(0,0)),
    'regisztral' => array('fajl' => 'regisztral', 'szoveg' => '', 'menun' => array(0,0)),
    'suti_uj' => array('fajl' => 'suti_uj', 'szoveg' => 'Új sütemény', 'menun' => array(0,0))
);

$hiba_oldal = array ('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!');
?>
