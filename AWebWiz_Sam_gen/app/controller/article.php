<?php

//C'est pour inclure les articles.
// Ce fichier contient la fonction get_article_a() qui permet de récupérer les informations des articles.
require_once '../app/model/article.php';
//C'est pour inclure les articles.
require_once '../app/view/article.php';

//Fonction pour gère l'affichage des articles.
function main_article()
{
    // Récupération de l'identifiant de l'article depuis l'URL (paramètre GET 'art_id').
    // Si le paramètre n'est pas défini, on utilise par défaut la valeur '1'.
    $art_id = $_GET['art_id'] ?? '1';
    // Récupérer les données de l'article correspondant à l'identifiant avec la fonction get_article_a .
    $article_a = get_article_a($art_id);

    // Permet d'assembler les parties avec un retour à la ligne ("\n").
    // Générer la page HTML
    return join("\n", [
        ctrl_head(),
        html_article_main($article_a),
        html_foot(),
    ]);
}

?>
