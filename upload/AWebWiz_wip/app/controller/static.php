<?php
function main_static():string
{
    $name = $_GET['name'] ?? '404'; // On récupère le nom de la page statique à afficher
    $html_body = get_static_content($name); // Fonction qui récupère le contenu de la page statique

    return join( "\n", [
        ctrl_head(),
        $html_body, // Affichage du contenu de la page
        html_foot(),
    ]);
}