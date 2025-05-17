<?php
//Fonction principale pour la page "time".



// Modèle pour récupérer les articles de la base press_2024_v03
require_once '../app/model/article.php';
//View contient le formulaire et l'affichage des articles filtrés
require_once '../app/view/time.php';

function main_time() {
    // Récupération du temps de lecture saisi par l'utilisateur (champ "min")
    $min = isset($_POST['min']) ? ($_POST['min']) : null;

    // Récupération du nombre d'articles à afficher
    //Je limiter le nombre d'articles sur page.
    $limit = isset($_POST['limit']) ? ($_POST['limit']) : DEFAULT_SEARCH_LIMIT;

    // Récupération des articles depuis la base de données.
    // La fonction get_all_article_a() se charge de demander press_2024_v03
    //les articles.
    $all_articles = get_all_article_a('', $limit);

    // Filtrage des articles en fonction du temps de lecture souhaité
    // Je fait un tableau pour stocker les articles qui correspondent au temps de lecture demandé.
    $filtered_articles = [];
    if ($min !== null) {
        //Vérification du temps de lecture.
        foreach ($all_articles as $article) {
            // Calcul du temps de lecture estimé grâce à la fonction estimate_time()
            $reading_time = estimate_time($article['content']);
            // Si le temps calculé correspond exactement à la durée demandée, on garde cet article
            if ($reading_time == $min) {
                $filtered_articles[] = $article;
            }
        }
    }

    // On génère le code HTML complet de la page :
    // - ctrl_head() : l'en-tête commun (menu, styles, etc.)
    // - html_time_search_form() : le formulaire de recherche (avec la durée et le nombre d'articles)
    // - html_time_list() : la liste des articles filtrés avec leur temps de lecture et un lien vers chaque article
    // - html_foot() : le pied de page commun
    $html = join("\n", [
        ctrl_head(),
        html_time_search_form($min, $limit),
        html_time_list($filtered_articles),
        html_foot()
    ]);

    //Renvoie du code HTML pour que le navigateur l'afficher.
    return $html;
}
