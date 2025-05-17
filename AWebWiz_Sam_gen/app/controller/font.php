<?php
// Contrôleur pour la gestion des préférences de police et de bordure

function main_font() {
    // Si non connecté, on redirige
    if (!isset($_SESSION['user'])) { // Vérifie si l'utilisateur n'est pas connecté
        $url = $_POST['current_url'] ?? 'index.php?page=home'; // Récupère l'URL d'origine ou redirige vers la page d'accueil
        header("Location: $url"); // Envoie un header pour redirection HTTP
        exit; // Termine l'exécution du script
    }

    // Police
    if (isset($_POST['font'])) { // Vérifie si une valeur de police a été envoyée via POST
        if ($_POST['font'] === "") { // Si la police est vide
            unset($_SESSION['font']); // Supprime la police stockée en session
        } else {
            $_SESSION['font'] = $_POST['font']; // Sinon, stocke la nouvelle police en session
        }
    }
    // Bordure
    if (isset($_POST['border'])) { // Vérifie si une valeur de bordure a été envoyée via POST
        if ($_POST['border'] === "none" || $_POST['border'] === "") { // Si bordure 'none' ou vide
            unset($_SESSION['border']); // Supprime la bordure stockée en session
        } else {
            $_SESSION['border'] = $_POST['border']; // Sinon, stocke le style de bordure en session
        }
    }

    // Retour à la page d'origine
    $url = $_POST['current_url'] ?? 'index.php?page=home'; // Récupère l'URL d'origine ou la page d'accueil par défaut
    header("Location: $url"); // Envoie un header pour redirection HTTP
    exit; // Termine l'exécution du script
}
