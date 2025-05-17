<?php
require_once '../app/model/article.php'; // OBLIGATOIRE ici : Charge le modèle Article pour accéder aux fonctions statistiques
require_once '../app/view/stats.php';    // Charge la vue Stats si stat.php existe dans app/view

function main_stats() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { // Vérifie que l'utilisateur est admin
        return "Accès interdit."; // Retourne un message d'erreur si non autorisé
    }

    $categories = get_stats_categories_with_count();  // Récupère les statistiques : catégories et leur nombre d'articles

    return join("\n", [
        ctrl_head(),
        html_stats_categories_with_count($categories), // Génère la vue des statistiques par catégorie
        html_foot()
    ]);
}
