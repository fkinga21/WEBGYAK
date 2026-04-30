<?php
// Ellenőrizzük, hogy a szükséges POST adatok (felhasználónév és jelszó) megérkeztek-e
if(isset($_POST['felhasznalo']) && isset($_POST['jelszo'])) {
    try {
        // Kapcsolódás
        $dbh = new PDO('mysql:host=mysql.omega;dbname=cukorweb1', 'cukorweb1', 'sutike21*',
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        
        
        // Felhsználó keresése
        $sqlSelect = "select id, csaladi_nev, uto_nev from felhasznalok where bejelentkezes = :bejelentkezes and jelszo = sha1(:jelszo)";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo'], ':jelszo' => $_POST['jelszo']));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $_SESSION['csn'] = $row['csaladi_nev']; $_SESSION['un'] = $row['uto_nev']; $_SESSION['login'] = $_POST['felhasznalo'];
        }
        // (Ha nincs találat, akkor nem történik semmi → nincs hibaüzenet)
    }
    catch (PDOException $e) {
        // Adatbázis hiba kezelése
        $errormessage = "Hiba: ".$e->getMessage();
    }      
}
else {
    // Ha nem POST-ból jött a kérés, visszairányítjuk a főoldalra
    header("Location: .");
}
?>
