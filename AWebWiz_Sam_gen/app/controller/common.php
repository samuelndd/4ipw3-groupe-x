<?php

function ctrl_head()
{   // Déclaration de la fonction ctrl_head pour gérer l'en-tête
    if (!empty($_GET['ajax'])) {   // Vérifie si la requête est AJAX
        return '';   // Si AJAX, retourne une chaîne vide
    }

    // Récupération des infos utilisateur
    $user_id = $_SESSION['user'] ?? '';      // Identifiant utilisateur récupéré depuis la session
    $user_role = $_SESSION['role'] ?? '';    // Rôle utilisateur récupéré depuis la session

    $font = $_SESSION['font'] ?? null;       // Récupère la police sélectionnée en session
    $bg_color = $_SESSION['bg_color'] ?? null;   // Récupère la couleur de fond en session
    $border = $_SESSION['border'] ?? null;    // Récupère le style de bordure en session

    // On récupère le menu CSV enrichi avec 'role'
    $menu_a = get_menu_csv();   // Appelle la fonction pour obtenir le menu enrichi

    // On filtre le menu selon le rôle de l'utilisateur
    $menu_a = array_filter($menu_a, function($item) use ($user_role) {
        $role = $item['role'];    // Extrait le rôle autorisé pour l'élément de menu

        if ($role === 'public') {
            return true;   // Si rôle public, visible pour tous
        }
        if ($role === 'user' && isset($_SESSION['user'])) {
            return true;   // Si rôle user et utilisateur connecté, visible
        }
        if ($role === 'admin' && $user_role === 'admin') {
            return true;   // Si rôle admin et utilisateur est admin, visible
        }
        return false;  // Sinon, masque l'élément
    });

    $current_url = $_SERVER['REQUEST_URI'] ?? 'index.php?page=home';   // Récupère l'URL courante ou URL par défaut

    return html_head($menu_a, $user_id, $user_role, $font, $bg_color, $current_url, $border);   // Génère et retourne le HTML de l'en-tête
}
