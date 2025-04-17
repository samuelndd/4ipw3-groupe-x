<?php

require_once '../app/model/article.php';
// Charger le modèle articlepour récupérer toutes les infos sur les articles
require_once '../app/view/home.php'; // Charger la vue home

function main_home():string
{


    // Récupérer tous les articles
    $articles = get_all_article_ac_sql();

// Extraire le premier article pour l'affichage principa
    $bottom_article_aa =  $articles[0];
//join concatener les chaines des caractere
    return join( "\n", [
        ctrl_head(),
        html_home_main( $bottom_article_aa, $articles,),
        html_foot(),
    ]);

}
