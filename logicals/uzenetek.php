<?php
// Ellenőrizzük, hogy van-e már aktív session (munkamenet)
// Ha nincs, akkor elindítjuk
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Megnézzük, hogy a felhasználó be van-e jelentkezve
// A 'login' session változó jelzi ezt
if (!isset($_SESSION['login'])) {
    // Ha nincs bejelentkezve, átirányítjuk a belépési oldalra
    header("Location: /belepes");
    // A script futását leállítjuk, hogy ne fusson tovább a kód
    exit();
}
// SQL lekérdezés összeállítása:
// Lekérjük a 'uzenetek' táblából a nevet, emailt, üzenetet és dátumot
// Az eredményeket dátum szerint csökkenő sorrendbe rendezzük (legfrissebb elöl)
$sql = "SELECT nev, email, uzenet, datum FROM uzenetek ORDER BY datum DESC";
// A lekérdezést lefuttatjuk az adatbázison
// Az eredményt a $stmt változóban kapjuk meg (általában PDOStatement objektum)
$stmt = $db->query($sql);

?>
