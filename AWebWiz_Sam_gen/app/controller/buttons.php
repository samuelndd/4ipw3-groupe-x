<?php
// Permet de choisir la police et la couleur de fond.

// Pour générer la liste déroulante pour la sélection de la police.
function get_font_dropdown() { // Déclaration de la fonction pour dropdown police
    // Tableau des polices proposées
    // menu déroulant
    $fonts = [ // Définition des polices disponibles
        "" => " Défaut", // Option par défaut si aucune police sélectionnée
        "Arial, sans-serif" => "Arial", // Police Arial
        "'Times New Roman', serif" => "Times New Roman", // Police Times New Roman
        "'Courier New', monospace" => "Courier New" // Police Courier New
    ];

    // Récupération de la police en session (si définie)
    $selectedFont = $_SESSION['font'] ?? ""; // Utilise la police stockée ou chaîne vide

    $html = '<select name="font" id="font">'; // Ouverture de la balise select pour police
    // Pour créer un dropdown
    foreach ($fonts as $value => $label) { // Itération sur chaque police
        // Si la valeur correspond à la police sélectionnée, on ajoute 'selected'
        $selected = ($value === $selectedFont) ? ' selected' : ''; // Attribut selected conditionnel
        $html .= '<option value="'.($value).'"'.$selected.'>'.($label).'</option>'; // Ajout de l'option au HTML
    } // Fin de foreach
    $html .= '</select>'; // Fermeture de la balise select
    return $html; // Renvoie le HTML généré
}

// Pour générer la liste déroulante pour la sélection de la couleur.
function get_bg_color_dropdown() { // Déclaration de la fonction pour dropdown couleur de fond
    // Tableau des couleurs proposées
    $colors = [ // Définition des couleurs disponibles
        "white"  => "white", // Couleur blanche
        "blue"   => "Blue",  // Couleur bleue
        "red"    => "Red",   // Couleur rouge
        "orange" => "Orange",// Couleur orange
        "green"  => "Green"  // Couleur verte
    ];

    // Récupération de la couleur en session, sinon blanc par défaut
    $selectedColor = $_SESSION['bg_color'] ?? "white"; // Utilise la couleur stockée ou 'white'

    $html = '<select name="bg_color" id="bg_color">'; // Ouverture de la balise select pour couleur
    foreach ($colors as $value => $label) { // Itération sur chaque couleur
        // Ajout de 'selected' si la valeur correspond à la couleur sélectionnée
        $selected = ($value === $selectedColor) ? ' selected' : ''; // Attribut selected conditionnel
        $html .= '<option value="'.($value).'"'.$selected.'>'.($label).'</option>'; // Ajout de l'option au HTML
    } // Fin de foreach
    $html .= '</select>'; // Fermeture de la balise select
    return $html; // Renvoie le HTML généré
}

// Génère la liste déroulante pour la sélection de la bordure.
function get_border_dropdown($selectedBorder = null) { // Déclaration de la fonction pour dropdown bordure
    // Définition des options de bordure
    $borders = [ // Définition des styles de bordure disponibles
        "none"  => "Aucune", // Pas de bordure
        "thin"  => "Fine",   // Bordure fine
        "thick" => "Épaisse" // Bordure épaisse
    ];

    $html = '<select name="border" id="border">'; // Ouverture de la balise select pour bordure
    foreach ($borders as $value => $label) { // Itération sur chaque type de bordure
        // Ajout de 'selected' si la valeur correspond à la bordure sélectionnée
        $selected = ($value === $selectedBorder) ? ' selected' : ''; // Attribut selected conditionnel
        $html .= '<option value="'.($value).'"'.$selected.'>'.($label).'</option>'; // Ajout de l'option au HTML
    } // Fin de foreach
    $html .= '</select>'; // Fermeture de la balise select
    return $html; // Renvoie le HTML généré
}

?>
