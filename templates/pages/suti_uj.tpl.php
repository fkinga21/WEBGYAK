<h2>Új sütemény felvétele</h2>
<form action="/suti_uj" method="post" style="max-width: 400px; margin: 20px 0;">
    
    <div style="margin-bottom: 15px;">
        <label>Név:</label><br>
        <input type="text" name="nev" placeholder="pl. Dobos torta" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Típus:</label><br>
        <input type="text" name="tipus" placeholder="pl. Torta" required style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Díjazott (1 = Igen, 0 = Nem):</label><br>
        <input type="number" name="dijazott" min="0" max="1" placeholder="0" style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Ár:</label><br>
        <input type="number" name="ertek" placeholder="pl. 1200" style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Egység:</label><br>
        <input type="text" name="egyseg" placeholder="pl. 6 szelet vagy kg" style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Mentesség:</label><br>
        <input type="text" name="mentes" placeholder="pl. G = Gluténmentes" style="width: 100%;">
    </div>

    <button type="submit" name="kuldes" class="btn">Mentés</button>
</form>