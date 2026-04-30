<?php

$host = 'mysql.omega';
$db   = 'cukorweb1'; 
$user = 'cukorweb1';
$pass = 'sutike21*';

try {
    $db = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8', $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Hiba: ' . $e->getMessage());
}
$ablakcim = array(
    'cim' => 'CUKI',
);

$fejlec = array(
    'kepforras' => 'sutikelogo.png',
    'kepalt' => 'logo',
	'cim' => 'Cukrászda Adminisztráció',
	'motto' => ''
);

$lablec = array(
    'copyright' => 'Copyright '.date("Y").'.',
    'ceg' => 'Cukrászda Adminisztráció | Készítette: Baricza Lili Viktória(fagcko) & Fődi Kinga(ew67ro)'
);

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
    'suti_uj' => array('fajl' => 'suti_uj', 'szoveg' => 'Új sütemény', 'menun' => array(0,0)),
    'suti_szerkeszt' => array('fajl' => 'suti_szerkeszt', 'szoveg' => 'Szerkesztés', 'menun' => array(0,0))
);

$hiba_oldal = array ('fajl' => '404', 'szoveg' => 'A keresett oldal nem található!');
?>