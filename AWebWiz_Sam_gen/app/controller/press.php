<?php
require_once '../app/model/article.php';  // Charge le modèle Article pour accéder aux données des articles
require_once '../app/view/article.php'; // Charge la vue Article pour générer l'affichage HTML

function main_press() // Déclaration de la fonction main_press pour la page "Press"
{   // Début de la fonction main_press
    $category_id = $_GET['cat_id'] ?? null; // Récupère l'ID de catégorie depuis la requête, ou null si absent

    // si pas de filtre catégorie → affiche tout
    $all_article_a = ($category_id) // Si un filtre de catégorie est présent
        ? get_all_article_by_category($category_id) // Récupère les articles de la catégorie spécifiée
        : get_all_article_a('', 20); // Sinon, récupère les 20 derniers articles sans filtre

    return join("\n", [
        ctrl_head(),
        html_all_articles_main($all_article_a), // Génère la section principale avec la liste d'articles
        html_foot(),
    ]);
}
