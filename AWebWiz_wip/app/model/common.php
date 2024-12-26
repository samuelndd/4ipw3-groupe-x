<?php
//fonction qui nous permet directement le contenue du fichier ds une variable
// on va creer une fonction qui va lire menu.csv
//get_menu_csv c'est le model
function get_menu_csv()
{
    $fn = '../asset/database/menu.csv';
    //recuper tout contenon on chaine de caractere
    $menu_s = file_get_contents($fn);
    $menu_a = explode("\n", $menu_s);
    $menu_aa = [];
    foreach ($menu_a as $line)
    {
        $menu_aa[] = explode ('|', $line );
    }
    return $menu_aa;
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


