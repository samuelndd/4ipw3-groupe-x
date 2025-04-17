<?php


//Les fonctions nécessaires pour récupérer le contenu statique.
require_once '../app/model/static.php';

function main_static(): string
{
    // Récupère le nom de la page statique
    $name = $_GET['name'] ?? '404';
    $html_body = get_static_content($name);

    return join("\n", [
        ctrl_head(),
        $html_body,
        html_foot(),
    ]);
}
?>



