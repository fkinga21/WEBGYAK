<?php
// Ellenőrizzük, van-e üzenet a munkamenetben
if (isset($_SESSION['uzenet'])) {
    echo "<div style='padding: 10px; margin: 10px 0; border: 1px solid #ccc;'>";
    echo $_SESSION['uzenet'];
    echo "</div>";
    // Töröljük, hogy ne jelenjen meg újra az oldal frissítésekor
    unset($_SESSION['uzenet']);
}
?>
<div>
    <h2>Képgaléria</h2>
    <div class="galeria">
        <?php
        $kepek = glob("images/galeria/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        foreach ($kepek as $kep) {
            echo '<img src="'.$kep.'" alt="Kép a galériában">';
        }
        ?>
    </div>

    <?php if (isset($_SESSION['login'])) : ?>
        <hr>
        <h3>Új kép feltöltése</h3>
        <form action="logicals/feltoltes.php" method="post" enctype="multipart/form-data">
            <input type="file" name="feltoltott_kep" required>
            <button type="submit" class="btn">Feltöltés</button>
        </form>
    <?php else : ?>
        <p>A képek feltöltéséhez kérjük, <strong>jelentkezzen be!</strong></p>
    <?php endif; ?>
</div>