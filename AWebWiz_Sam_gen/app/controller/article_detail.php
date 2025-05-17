<?php
require_once '../app/model/article.php'; // Charge le modèle Article pour accéder aux fonctions de gestion des articles
require_once '../app/view/article.php'; // Charge la vue Article pour générer la présentation HTML

/**
 * Contrôleur pour retourner les détails d’un article via AJAX.
 */
function main_article_detail() { // Fonction principale pour récupérer les détails d’un article
    $art_id = $_GET['art_id'] ?? 0; // Récupère l’ID de l’article depuis la requête, ou 0 par défaut
    $article = get_article_a($art_id); // Appelle la fonction du modèle pour obtenir les données de l’article

    // Si article non trouvé, on renvoie rien
    if (!$article) return ''; // Retourne une chaîne vide si l’article n’existe pas ou n’a pas été trouvé

    // Calcul du nombre de mots & temps de lecture
    $article['word_count'] = str_word_count(strip_tags($article['content'] ?? '')); // Compte les mots dans le contenu texte de l’article
    $article['reading_time'] = ceil($article['word_count'] / 200); // Estime le temps de lecture (200 mots par minute)

    // Génération du fragment HTML pour l’overlay
    return html_article_detail_overlay($article); // Retourne le HTML généré par la vue pour l’affichage en overlay
}
