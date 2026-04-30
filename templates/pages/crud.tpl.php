<h2>Sütemények kezelése</h2>
<a href="suti_uj" class="btn">Add New</a>

<form action="/crud" method="post">
<table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr>
            <th>Név</th>
            <th>Típus</th>
            <th>Díjazott</th>
            <th>Mentesség</th>
            <th>Ár</th>
            <th>Egység</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sutik as $row): ?>
        <tr id="sor-<?= $row['id'] ?>">
            <?php if (isset($_SESSION['szerkeszt_id']) && $_SESSION['szerkeszt_id'] == $row['id']): ?>
                <!-- SZERKESZTŐ MÓD: Input mezők jelennek meg -->
                <input type="hidden" name="mentes_id" value="<?= $row['id'] ?>">
                <td><input type="text" name="nev" value="<?= htmlspecialchars($row['nev']) ?>"></td>
                <td><input type="text" name="tipus" value="<?= htmlspecialchars($row['tipus']) ?>"></td>
                <td><input type="number" name="dijazott" value="<?= $row['dijazott'] ?>"></td>
                <td><input type="text" name="mentes" value="<?= htmlspecialchars($row['mentes']) ?>"></td>
                <td><input type="number" name="ertek" value="<?= $row['ertek'] ?>"></td>
                <td><input type="text" name="egyseg" value="<?= htmlspecialchars($row['egyseg']) ?>"></td>
                <td>
                    <button type="submit" class="btn-save">Mentés</button>
                    <button type="submit" name="megse" value="1" class="btn-exit">Mégse</button>
                </td>
            <?php else: ?>
                <!-- OLVASÓ MÓD: Sima szöveg és POST-os gombok -->
                <td><?= htmlspecialchars($row['nev']) ?></td>
                <td><?= htmlspecialchars($row['tipus']) ?></td>
                <td><?= $row['dijazott'] ? 'Igen' : 'Nem' ?></td>
                <td><?= htmlspecialchars($row['mentes']) ?></td>
                <td><?= htmlspecialchars($row['ertek']) ?></td>
                <td><?= htmlspecialchars($row['egyseg']) ?></td>
                <td>
                    <!-- Edit gomb POST-al -->
                    <button type="submit" name="szerkeszt_id" value="<?= $row['id'] ?>" class="btn-edit">Edit</button>
                    
                    <!-- Delete gomb POST-al -->
                    <button type="submit" name="torol_id" value="<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Biztos törlöd?')">Delete</button>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</form>