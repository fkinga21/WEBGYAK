<?php
// Ellenőrizzük, hogy minden szükséges POST adat megérkezett-e az űrlapról
if(isset($_POST['felhasznalo']) && isset($_POST['jelszo']) && isset($_POST['vezeteknev']) && isset($_POST['utonev'])) {
    try {
        // Kapcsolódás
        $dbh = new PDO('mysql:host=mysql.omega;dbname=cukorweb1', 'cukorweb1', 'sutike21*', // adatbázis elérési út, felhasználónév, jelszó 
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); // hibakezelés: kivétel dobása
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        
        // Létezik már a felhasználói név?
        $sqlSelect = "select id from felhasznalok where bejelentkezes = :bejelentkezes";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo']));
        if($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $uzenet = "A felhasználói név már foglalt!";
            $ujra = "true";
        }
        else {
            // Ha nem létezik, akkor regisztráljuk
            $sqlInsert = "insert into felhasznalok(id, csaladi_nev, uto_nev, bejelentkezes, jelszo)
                          values(0, :csaladinev, :utonev, :bejelentkezes, :jelszo)";
            $stmt = $dbh->prepare($sqlInsert); 
            $stmt->execute(array(':csaladinev' => $_POST['vezeteknev'], ':utonev' => $_POST['utonev'],
                                 ':bejelentkezes' => $_POST['felhasznalo'], ':jelszo' => sha1($_POST['jelszo'])));
            // Ellenőrizzük, hogy történt-e beszúrás
            if($count = $stmt->rowCount()) {
                // Lekérjük az újonnan létrehozott rekord ID-ját
                $newid = $dbh->lastInsertId();
                // Sikeres regisztráció üzenet
                $uzenet = "A regisztrációja sikeres.<br>Azonosítója: {$newid}.<br>Kérjük, <a href='belepes'>jelentkezzen be</a>.";
                $ujra = false;
            }
            else {
                 // Ha nem sikerült a beszúrás
                $uzenet = "A regisztráció nem sikerült.";
                $ujra = true;
            }
        }
    }
    catch (PDOException $e) {
        // Adatbázis hiba esetén ide jutunk
        $uzenet = "Hiba: ".$e->getMessage();
        $ujra = true;
    }      
}
else {
    // Ha nem érkeztek meg a szükséges adatok, visszairányítjuk a főoldalra
    header("Location: .");
}
?>
