<?php
// Munkamenet indítása az üzenet fogadásához
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<h2>Írjon nekünk!</h2>

<?php if (isset($_SESSION['uzenet'])): ?>
    <div style="padding: 15px; margin: 10px 0; border: 2px solid green; background-color: #d4edda; color: #155724; font-weight: bold;">
        <?php 
            echo $_SESSION['uzenet']; 
            unset($_SESSION['uzenet']); 
        ?>
    </div>
<?php endif; ?>

<form id="kapcsolatForm" action="/kapcsolat" method="post" onsubmit="return validateForm()" style="max-width: 500px; margin: 20px 0;">
    
    <div style="margin-bottom: 15px;">
        <label for="nev" style="display: block; margin-bottom: 5px;">Név:</label>
        <input type="text" id="nev" name="nev" placeholder="Adja meg a nevét" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
        <input type="email" id="email" name="email" placeholder="pelda@email.hu" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="uzenet" style="display: block; margin-bottom: 5px;">Üzenet:</label>
        <textarea id="uzenet" name="uzenet" rows="5" placeholder="Írja ide az üzenetét..." required style="width: 100%; padding: 8px;"></textarea>
    </div>

    <button type="submit" class="btn" style="padding: 10px 20px; background-color: #db76e3; ; color: white; border: none; cursor: pointer;">Küldés</button>
</form>

<script>
function validateForm() {
    let nev = document.getElementById('nev').value;
    let email = document.getElementById('email').value;
    let uzenet = document.getElementById('uzenet').value;

    if (nev.length < 3) { alert("A név túl rövid!"); return false; }
    if (email.indexOf("@") == -1) { alert("Hibás email formátum!"); return false; }
    if (uzenet.length < 10) { alert("Az üzenet túl rövid!"); return false; }
    return true;
}

if (isset($_SESSION['uzenet'])) {
    echo "<div style='color: green; font-weight: bold;'>".$_SESSION['uzenet']."</div>";
    unset($_SESSION['uzenet']);
}
</script>