<?php
	// Konfiguráció betöltése (oldalak, hibakezelés stb.)
	include('./includes/config.inc.php');
	//include_once(__DIR__ . '/includes/config.inc.php');
	// Az URL utáni query string lekérése
	$oldal = $_SERVER['QUERY_STRING'];
	//$oldal = isset($_GET['oldal']) ? $_GET['oldal'] : 'cimlap';
	// Ha van megadva oldal
	if ($oldal!="") {
		// Megnézzük:
		// 1. létezik-e az oldal a tömbben
		// 2. létezik-e a hozzá tartozó template fájl
		if (isset($oldalak[$oldal]) && file_exists("./templates/pages/{$oldalak[$oldal]['fajl']}.tpl.php")) {
			// Ha igen, akkor ezt az oldalt töltjük be
			$keres = $oldalak[$oldal];
		}
		else {
			// Ha nem létezik
			$keres = $hiba_oldal;
			// 404-es státuszkód küldése
			header("HTTP/1.0 404 Not Found");
		}
	}
	else $keres = $oldalak['/'];
	include('./templates/index.tpl.php'); 
?>
