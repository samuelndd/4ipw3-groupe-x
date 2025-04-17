<?php
// permettant de choisir la police et la couleur de fond.

// Pour génère la liste déroulante pour la sélection de la police.

function get_font_dropdown() {
    // Tableau des polices proposées
    //menu déroulant
    $fonts = [
        "" => " Défaut",
        "Arial, sans-serif" => "Arial",
        "'Times New Roman', serif" => "Times New Roman",
        "'Courier New', monospace" => "Courier New"
    ];

    // Récupération de la police en session (si elle existe)
    $selectedFont = $_SESSION['font'] ?? "";

    $html = '<select name="font" id="font">';
    //Pour créer un dropdown
    foreach ($fonts as $value => $label) {
        // Si la valeur correspond à celle stockée, ajoute l'attribut selected
        $selected = ($value === $selectedFont) ? ' selected' : '';
        $html .= '<option value="'.htmlspecialchars($value).'"'.$selected.'>'.htmlspecialchars($label).'</option>';
    }
    $html .= '</select>';
    return $html;
}

// Pour génère la liste déroulante pour la sélection de la couleur.

function get_bg_color_dropdown() {
    // Tableau des couleurs proposées
    $colors = [
        "white"  => "white",
        "blue"  => "Blue",
        "red"   => "Red",
        "orange"=> "Orange",
        "green" => "Green"
    ];

    // Récupération de la couleur en session, sinon "white" par défaut
    $selectedColor = $_SESSION['bg_color'] ?? "white";

    $html = '<select name="bg_color" id="bg_color">';
    foreach ($colors as $value => $label) {
        // Ajout de l'attribut selected si la valeur correspond
        $selected = ($value === $selectedColor) ? ' selected' : '';
        $html .= '<option value="'.($value).'"'.$selected.'>'.($label).'</option>';
    }
    $html .= '</select>';
    return $html;
}


function get_border_dropdown($selectedBorder = null) {
    // Définition des options de bordure
    $borders = [
        "none"  => "Aucune",
        "thin"  => "Fine",
        "thick" => "Epaisse"
    ];

    $html = '<select name="border" id="border">';
    foreach ($borders as $value => $label) {
        $selected = ($value === $selectedBorder) ? ' selected' : '';
        $html .= '<option value="' . ($value) . '"' . $selected . '>' . ($label) . '</option>';
    }
    $html .= '</select>';
    return $html;
}



?>
