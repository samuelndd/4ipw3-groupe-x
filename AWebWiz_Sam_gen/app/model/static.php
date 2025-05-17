<?php
// app/model/static.php

function get_static_content($name)
{
    // Construire le chemin absolu vers le fichier HTML
    $fn = __DIR__ . '/../../asset/static_content/' . $name . '.html';

    // Vérifier si le fichier existe avant de l'ouvrir
    if (!file_exists($fn)) {
        // Si le fichier n'existe pas → message d'erreur propre
        return "<h2>Erreur : la page demandée n'existe pas.</h2>";
    }

    // Lire et retourner le contenu du fichier
    return file_get_contents($fn);
}
