<?php

require_once '../app/model/article.php'; // Charger le modèle article pour récupérer toutes les infos sur les articles
require_once '../app/view/home.php';

function main_home(): string // Fonction principale pour générer la page d'accueil
{
    // On récupère les 10 derniers articles
    $articles = get_all_article_ac_sql(20); // Appel du modèle pour obtenir les 20 derniers articles

    // Si on a au moins 5 articles, on prend le 5ᵉ comme principal
    if (count($articles) >= 5) { // Vérifie qu'il y a au moins 5 articles
        $featured = $articles[4]; // Désigne le 5ᵉ article comme mis en avant
        unset($articles[4]); // Retire l'article mis en avant de la liste des autres
    } else { // Sinon, fallback sur le premier
        $featured = $articles[0]; // Désigne le premier article comme mis en avant
        unset($articles[0]); // Retire le premier article de la liste des autres
    } // Fin du conditionnel de sélection de l'article mis en avant

    // On ré-indexe les autres pour former notre grille
    $others = array_values($articles); // Ré-indexe le tableau des autres articles

    return join("\n", [
        ctrl_head(), // Appelle le contrôleur de l'en-tête
        html_home_main($featured, $others), // Génère le HTML principal avec l'article mis en avant et les autres
        html_foot(), // Génère le pied de page
    ]);
}
