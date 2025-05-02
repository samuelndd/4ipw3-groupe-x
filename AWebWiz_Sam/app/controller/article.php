<?php

//C'est pour inclure les articles.
// Ce fichier contient la fonction get_article_a() qui permet de récupérer les informations des articles.
require_once '../app/model/article.php';
//C'est pour inclure les articles.
require_once '../app/view/article.php';

//Fonction pour gère l'affichage des articles.

function main_article()
{
    // 1) On récupère l'ID en GET (par défaut 1 si rien)
    $art_id = $_GET['art_id'] ?? '1';
    // 2) On va chercher l'article dans le modèle
    $article_a = get_article_a($art_id);

    // 3) On assemble l'en-tête, le détail et le pied
    return join("\n", [
        ctrl_head(),
        html_article_main($article_a),
        html_foot(),
    ]);
}