<?php

function main_search()
{
    // get articles based on the user's keyword
    $kw = $_POST['search_kw'] ?? '';
    //Prends la limite de résultats à afficher.
    $limit = $_POST['search_limit'] ?? DEFAULT_SEARCH_LIMIT;
    // Récupération des dates
    $date_min = $_POST['search_date_min'] ?? '';
    $date_max = $_POST['search_date_max'] ?? '';
    //La baser du code c'est celle du prof pour cette partie.
    $all_article_a = get_all_article_a($kw, $limit,$date_min, $date_max);

    // get HTML code
    return join( "\n", [
        ctrl_head(),
        html_search_form($kw, $limit,$date_min, $date_max),
        html_all_articles_main($all_article_a),
        html_foot(),
    ]);
}
