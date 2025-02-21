<?php
// controller.php
$baseDir = dirname(__DIR__); // Chemin du dossier "app"
require_once("$baseDir/model/color.php");
require_once("$baseDir/view/color.php");


// Définit une fonction pour générer l'en-tête HTML
function _head($bg_color)
{
    $cl1 = formBackground($bg_color); // Génère le formulaire pour changer la couleur de fond
    $cl2 = styleSheet($bg_color); // Génère les styles CSS pour appliquer la couleur de fond
    return html_head($bg_color, $cl1, $cl2); // Retourne l'en-tête HTML complet
}


// Récupère la couleur de fond depuis la session.
$bg_color = getBgColor();

if (isset($_POST['set_bgcolor'])) {
    // Si le formulaire est soumis, met à jour la couleur de fond.
    $bg_color = $_POST['my_color']; // Récupère la couleur sélectionnée
    setBgColor($bg_color); // Stocke la couleur sélectionnée dans la session
}
?>

