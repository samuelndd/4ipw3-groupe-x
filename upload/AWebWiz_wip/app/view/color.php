<?php
// VIEW

//Génère le formulaire pour sélectionner une couleur de fond
function formBackground($bg_color)
{
    return <<<HTML
<form method="post">
    <label for="colorSelect">Couleur</label>
    <select id="colorSelect" name="my_color">
        <option value="lightskyblue" " . ($bg_color === 'lightskyblue' ? 'selected' : '') . ">Lightskyblue</option>
        <option value="lightgreen" " . ($bg_color === 'lightgreen' ? 'selected' : '') . ">Lightgreen</option>
        <option value="lightpink" " . ($bg_color === 'lightpink' ? 'selected' : '') . ">Lightpink</option>
        <option value="lightcoral" " . ($bg_color === 'lightcoral' ? 'selected' : '') . ">Lightcoral</option>
        <option value="lightyellow" " . ($bg_color === 'lightyellow' ? 'selected' : '') . ">Lightyellow</option>
    </select>
    <button name="set_bgcolor" type="submit">Changer</button>
</form>
HTML;
}

// Génère le style CSS pour appliquer la couleur de fond
function styleSheet($bg_color)
    // Définit la couleur de fond du corps

{
    return <<<HTML
<style>
    body { background-color: $bg_color; }
</style>
HTML;
}
