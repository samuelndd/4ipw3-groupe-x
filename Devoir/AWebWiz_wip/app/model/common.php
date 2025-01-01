<?php

function get_menu_csv()
{
    $fn = '../asset/database/menu.csv';
    $menu_s = file_get_contents($fn);
    $menu_a = explode( "\n", $menu_s );
    $menu_aa = [];
    foreach ( $menu_a as $line )
    {
        $menu_aa[] = explode( '|', $line );
    }
    return $menu_aa;
}


function get_logor_csv()
{
    $fn = '../asset/database/logor.csv';
    //recuperer tout le menu
    $logor_s = file_get_contents($fn);
    //La fonction explode() divise la chaîne $menu_s en un tableau (array) en utilisant le caractère \n
    // comme séparateur. Chaque ligne devient un élément distinct du tableau.
    //Ce type de script est souvent utilisé pour :
    //Manipuler des listes de données formatées par des retours à la ligne.
    //Transformer une chaîne multi-lignes en un tableau pour faciliter le traitement.
    $logor_a = explode("\n", $logor_s);
    //creer tableau vide
    $logor_aa = [];
    foreach ($logor_a as $line) {
        $logor_aa[] = explode('|', $line);
    }
    return $logor_aa;
}


/**
 * retourne l'objet PDO
 * crée l'objet PDO s'il n'existe pas
 */
function get_pdo()
{
    static $pdo;

    if(empty($pdo))
    {
        $pdo = new PDO( DATABASE_DSN, DATABASE_USERNAME, DATABASE_PASSWORD);
        $pdo->query("SET NAMES UTF8");
    }

    return $pdo;
}
