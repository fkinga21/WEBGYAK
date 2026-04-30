<?php
// 1. TÖRLÉS (Delete) - POST alapon, hogy ne legyen paraméter az URL-ben
if (isset($_POST['torol_id'])) {
    $id = (int)$_POST['torol_id'];

    // Kapcsolt táblák törlése
    $db->prepare("DELETE FROM tartalom WHERE sutiid = :id")->execute([':id' => $id]);
    $db->prepare("DELETE FROM ar WHERE sutiid = :id")->execute([':id' => $id]);

    // Sütemény törlése
    $db->prepare("DELETE FROM suti WHERE id = :id")->execute([':id' => $id]);

    header("Location: /crud#sor-" . $id);
    exit();
}

// 2. SZERKESZTÉS BEÁLLÍTÁSA
if (isset($_POST['szerkeszt_id'])) {
    $_SESSION['szerkeszt_id'] = $_POST['szerkeszt_id'];
    header("Location: /crud#sor-" . $_POST['szerkeszt_id']); // Újratöltjük az oldalt, hogy tiszta maradjon az URL
    exit();
}

// 3. MÉGSE GOMB KEZELÉSE
if (isset($_POST['megse'])) {
    unset($_SESSION['szerkeszt_id']);
    header("Location: /crud#sor-" . $id);
    exit();
}

// 4. MENTÉS (Update) - Ha a mentés gombot nyomták meg
if (isset($_POST['mentes_id'])) {
    $id = $_POST['mentes_id'];

    // Frissítés a 'suti' táblában
    $stmt = $db->prepare("UPDATE suti SET nev=:nev, tipus=:tipus, dijazott=:dijazott WHERE id=:id");
    $stmt->execute([
        ':nev'      => $_POST['nev'],
        ':tipus'    => $_POST['tipus'],
        ':dijazott' => $_POST['dijazott'],
        ':id'       => $id
    ]);

    // Frissítés az 'ar' táblában
    $stmt = $db->prepare("UPDATE ar SET ertek=:ertek, egyseg=:egyseg WHERE sutiid=:id");
    $stmt->execute([
        ':ertek'  => $_POST['ertek'],
        ':egyseg' => $_POST['egyseg'],
        ':id'     => $id
    ]);

    // Frissítés a 'tartalom' táblában
    $stmt = $db->prepare("UPDATE tartalom SET mentes=:mentes WHERE sutiid=:id");
    $stmt->execute([
        ':mentes' => $_POST['mentes'],
        ':id'     => $id
    ]);

    unset($_SESSION['szerkeszt_id']); // Szerkesztés után töröljük a sessiont
    header("Location: /crud#sor-" . $id);
    exit();
}

// 5. OLVASÁS (Listázás) - Ez minden esetben lefut
$sql = "SELECT s.id, s.nev, s.tipus, s.dijazott, t.mentes, a.ertek, a.egyseg
        FROM suti s
        LEFT JOIN tartalom t ON s.id = t.sutiid
        LEFT JOIN ar a ON s.id = a.sutiid";
$sutik = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>