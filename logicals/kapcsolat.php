<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Az űrlapról érkező név eltárolása
    $nev = htmlspecialchars(trim($_POST['nev']));
    $email = trim($_POST['email']);
    $uzenet = htmlspecialchars(trim($_POST['uzenet']));

    // Szerveroldali ellenőrzés
    if (strlen($nev) < 3) { die("Hiba: A név túl rövid (min 3 karakter)!"); }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { die("Hiba: Érvénytelen email cím!"); }
    if (strlen($uzenet) < 10) { die("Hiba: Az üzenet túl rövid (min 10 karakter)!"); }

    // 2. Logika: Ha be van jelentkezve, az űrlapba írt nevet használjuk.
    // Ha NINCS bejelentkezve, akkor "Vendég" lesz a neve.
    if (isset($_SESSION['login'])) {
        $mentett_nev = $nev; // Az űrlapból jövő $nev változót használjuk
    } else {
        $mentett_nev = "Vendég";
    }

    // 3. Mentés az adatbázisba
    $sql = "INSERT INTO uzenetek (nev, email, uzenet, datum) VALUES (:nev, :email, :uzenet, NOW())";
    $stmt = $db->prepare($sql);
    // Paraméterek behelyettesítése és végrehajtás
    $stmt->execute([
        ':nev'    => $mentett_nev, 
        ':email'  => $email, 
        ':uzenet' => $uzenet
    ]);

    // 4. Visszajelzés és átirányítás
    $_SESSION['uzenet'] = "Az üzenetét sikeresen elmentettük!<br>" .
                      "Ha szeretné megtekinteni a többi üzenetet, " .
                      "<a href='/uzenetek'>kattintson ide</a>.</br>".
                      "Viszont  ha nincs bejelentkezve elsőnek be kell jelentkezni!</br>" .
                        " A bejelentkezéshez <a href='/uzenetek'>kattintson ide</a>.";
    // Visszirányítás a kapcsolat oldalra
    header("Location:  /kapcsolat");
    // A script futásának leállítása
    exit();
}
?>
