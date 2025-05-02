<?php

require_once '../app/model/article.php';
// Charger le modèle articlepour récupérer toutes les infos sur les articles
require_once '../app/view/home.php'; // Charger la vue home

function main_home():string
{

    // on récupère tous les articles
    $articles = get_all_article_ac_sql();

    // point d'entrée AJAX : on renvoie juste la liste
    if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
        return html_all_articles_main($articles);
    }

    //join concatener les chaines des caractere
    //On affiche l'accueil complet
    $featured = $articles[0];
    return join("\n", [
        ctrl_head(),
        html_home_main($featured, $articles),
        html_foot(),
    ]);
}