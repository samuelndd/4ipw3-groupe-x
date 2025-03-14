<?php

function ctrl_head()
{
    // Vérifier si l'utilisateur est connecté
    // get  info on user
    $user_id = $_SESSION['id'] ?? '';//ID utilisateur ou vide
    $user_role = $_SESSION['role'] ?? '';// Rôle utilisateur ou vide

    // Récupération du menu depuis le modèle
    // get menu array from csv
    $menu_a = get_menu_csv();

    return html_head( $menu_a, $user_id, $user_role );// Génération du menu HTML
}