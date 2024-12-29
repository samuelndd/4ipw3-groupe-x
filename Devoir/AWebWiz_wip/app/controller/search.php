<?php

function main_search()
{
    //fonction pour aller cherche les articles
    // get articles based on the user's keyword
    $kw = $_POST['search_kw'] ?? '';
    //search_limit veut dire lire cette valeur si elle existe pas DEFAULT_SEARCH_LIMIT
    $limit = $_POST['search_limit'] ?? DEFAULT_SEARCH_LIMIT;
    $all_article_a = get_all_article_a($kw, $limit);

    // get HTML code
    return join( "\n", [
        ctrl_head(),
        html_search_form($kw, $limit),
        html_all_articles_main($all_article_a),
        html_foot(),
    ]);
}

