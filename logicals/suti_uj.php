<?php
if (isset($_POST['kuldes'])) {
    // 1. Süti mentése
    $stmt = $db->prepare("INSERT INTO suti (nev, tipus, dijazott) VALUES (:nev, :tipus, :dijazott)");
    $stmt->execute([':nev' => $_POST['nev'], ':tipus' => $_POST['tipus'], ':dijazott' => $_POST['dijazott']]);
    $sutiid = $db->lastInsertId(); // Megkapjuk az új süti ID-ját

    // 2. Ár mentése
    $db->prepare("INSERT INTO ar (sutiid, ertek, egyseg) VALUES (:sutiid, :ertek, :egyseg)")
       ->execute([':sutiid' => $sutiid, ':ertek' => $_POST['ertek'], ':egyseg' => $_POST['egyseg']]);

    // 3. Mentesség mentése
    $db->prepare("INSERT INTO tartalom (sutiid, mentes) VALUES (:sutiid, :mentes)")
       ->execute([':sutiid' => $sutiid, ':mentes' => $_POST['mentes']]);

    header("Location: /crud");
}
?>