<h2>Elküldött üzenetek</h2>
<table border="1" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>Név</th>
            <th>E-mail</th>
            <th>Üzenet</th>
            <th>Küldés ideje</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // A $db változó az index.php-n keresztül globálisan elérhető
        // A tábla neve: 'uzenetek' (ha korábban ezt hoztad létre)
        $sql = "SELECT nev, email, uzenet, datum FROM uzenetek ORDER BY datum DESC";
        $stmt = $db->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Név ellenőrzése
            $nev = (!empty($row['nev'])) ? htmlspecialchars($row['nev']) : "Vendég";
            
            echo "<tr>";
            echo "<td>" . $nev . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['uzenet']) . "</td>";
            echo "<td>" . $row['datum'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>