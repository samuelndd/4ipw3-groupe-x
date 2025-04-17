<?php

function main_press()
{
    // get all articles
    //je récupère tous les articles, limité à 20
    $all_article_a = get_all_article_a('', 20);

    // get HTML code
    return join( "\n", [
        ctrl_head(),
        html_all_articles_main($all_article_a),
        html_foot(),
    ]);
}
