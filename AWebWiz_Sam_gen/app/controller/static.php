<?php
// app/controllers/static.php

require_once '../app/model/static.php';

function main_static(): string
{
    // Si 'name' n'est pas fourni dans l'URL, on affiche "about" par défaut
    $name = $_GET['name'] ?? 'about';

    // On récupère le contenu HTML de la page statique
    $html_body = get_static_content($name);

    // On assemble la page complète avec head, contenu et footer
    return join("\n", [
        ctrl_head(),
        $html_body,
        html_foot(),
    ]);
}
