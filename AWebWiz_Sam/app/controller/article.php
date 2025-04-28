<?php

//C'est pour inclure les articles.
// Ce fichier contient la fonction get_article_a() qui permet de récupérer les informations des articles.
require_once '../app/model/article.php';
//C'est pour inclure les articles.
require_once '../app/view/article.php';

//Fonction pour gère l'affichage des articles.
function main_article()
{
    header('Content-Type: application/json');
    $art_id = $_GET['art_id'] ?? null;
    if (!$art_id) {
        echo json_encode(['error' => 'Missing art_id']);
        return;
    }
    $article = get_article_a($art_id);
    echo json_encode($article);
}

?>
