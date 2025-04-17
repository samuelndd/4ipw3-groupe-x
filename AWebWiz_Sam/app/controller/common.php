<?php

function ctrl_head()
{
    //Verififier si l'utilisateur est connecté
    // get  info on user
    // Je récupère l'ID de l'utilisateur
    $user_id = $_SESSION['id'] ?? '';
    // Je récupère le rolr de l'utilisateur
    $user_role = $_SESSION['role'] ?? '';

    // Récupération de la police, couleur et bordur stockée en session
    $font = $_SESSION['font'] ?? null;
    $bg_color = $_SESSION['bg_color'] ?? null;
    $border = $_SESSION['border'] ?? null; // Récupération de la bordure
    //Recipération du menu depuis le model
    // get menu array from csv
    $menu_a = get_menu_csv();


    // Récuperation des données utiles pour la vue
    // Je récupère l'URL actuelle pour pouvoir marquer la page active
    $current_url = $_SERVER['REQUEST_URI'] ?? 'index.php?page=home';

    return html_head($menu_a, $user_id, $user_role, $font, $bg_color, $current_url, $border);

}