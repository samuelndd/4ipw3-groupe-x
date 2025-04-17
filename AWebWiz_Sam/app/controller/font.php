<?php
// Cette fonction gère les préférences de style de l'utilisateur (police, couleur de fond et bordure)



function main_font() {
    // Traitement de la police
    //Pour voir si une police a été envoyée par le formulaire.
    if (isset($_POST['font'])) {
        if ($_POST['font'] === "") {
            unset($_SESSION['font']);
            //je sauvegarde la police choisie dans la session.
        } else {
            $_SESSION['font'] = $_POST['font'];
        }
    }
    // Traitement de la couleur de fond
    if (isset($_POST['bg_color'])) {
        if ($_POST['bg_color'] === "white") {
            unset($_SESSION['bg_color']);
        } else {
            //sauvegarde la couleur choisie.
            $_SESSION['bg_color'] = $_POST['bg_color'];
        }
    }
    // Traitement de la bordure
    if (isset($_POST['border'])) {
        if ($_POST['border'] === "" || $_POST['border'] === "none") {
            unset($_SESSION['border']);
        } else {
            $_SESSION['border'] = $_POST['border'];
        }
    }
    // Redirection vers l'URL d'origine
    // Après avoir traité les modifications, je redirige l'utilisateur vers la page précédente.
    $current_url = $_POST['current_url'] ?? 'index.php?page=home';
    header("Location: " . $current_url);
    exit();
}
?>
