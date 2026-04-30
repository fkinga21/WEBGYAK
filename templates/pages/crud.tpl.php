<h2>Sütemények kezelése</h2>
<a href="suti_uj" class="btn">Add New</a>

<form action="/crud" method="post">
    <div class="table-responsive">
<table border="1" >
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
                <td data-label="Név:"><input type="text" name="nev" value="<?= htmlspecialchars($row['nev']) ?>"></td>
                <td data-label="Típus:"><input type="text" name="tipus" value="<?= htmlspecialchars($row['tipus']) ?>"></td>
                <td data-label="Díjazott:">
                    <select name="dijazott">
                    <option value="1" <?= $row['dijazott'] == 1 ? 'selected' : '' ?>>Igen</option>
                    <option value="0" <?= $row['dijazott'] == 0 ? 'selected' : '' ?>>Nem</option> 
                    </select>   
                </td>
                <td data-label="Mentes:"><input type="text" name="mentes" value="<?= !empty($row['mentes']) ? htmlspecialchars($row['mentes']) : '&nbsp;' ?>"></td>
                <td data-label="Ár:"><input type="number" name="ertek" value="<?= $row['ertek'] ?>"></td>
                <td data-label="Egység:"><input type="text" name="egyseg" value="<?= htmlspecialchars($row['egyseg']) ?>"></td>
                <td>
                    <button type="submit" class="btn-save">Mentés</button>
                    <button type="submit" name="megse" value="1" class="btn-exit">Mégse</button>
                </td>
            <?php else: ?>
                <!-- OLVASÓ MÓD: Sima szöveg és POST-os gombok -->
                <td data-label="Név:"><?= htmlspecialchars($row['nev']) ?></td>
                <td data-label="Típus:"><?= htmlspecialchars($row['tipus']) ?></td>
                <td data-label="Díjazott:"><?= $row['dijazott'] ? 'Igen' : 'Nem' ?></td>
                <td data-label="Mentes:"><?= !empty($row['mentes']) ? htmlspecialchars($row['mentes']) : '&nbsp;' ?></td>
                <td data-label="Ár:"><?= htmlspecialchars($row['ertek']) ?></td>
                <td data-label="Egység:"><?= htmlspecialchars($row['egyseg']) ?></td>
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
    </div>
</form>