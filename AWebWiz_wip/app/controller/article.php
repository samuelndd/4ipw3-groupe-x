<?php

/**
 * génère la page avec un (seul) article complet
 * @return string html
 */
function main_article()
{
    if (isset($_GET['art_id']))
    {
        $art_id = $_GET['art_id'] | '1';
    }
    else
    {
        $art_id = '1';
    }
     // TODO faire ne sorte que $_GET['art_id'] soit défini quand on séléctionne un article

    // récupérer les données de cet article
    $article_a = get_article_a($art_id);

    // générer la page html
    return join( "\n", [
        ctrl_head(),
        html_article_main($article_a),
        html_add_to_backsket_button($art_id),
        html_foot(),
    ]);
}