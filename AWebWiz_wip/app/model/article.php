<?php

/**
 * retourne l'article à affiche sur la home page
 * en premiere position
 * temporairement c'est l'article ds l'id 1
 * @return void
 */

function get_article_homepage()
{

    $fn = '../asset/database/article.json';
    //recuper tout contenon on chaine de caractere
    $art_db_str = file_get_contents($fn);
    $art_db_arw = json_decode($art_db_str, true);
    //$art_a va me prendre successivement les article un part un
    foreach ($art_db_arw as $art_a)
    {
        if ($art_a['id'] == 1) break;

    }
    //art_a a possede les donnes de l'article id 1
    return $art_a;
}
