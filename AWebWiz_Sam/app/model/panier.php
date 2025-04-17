<?php

//je récupérer les articles dans le model
require_once 'article.php';

 // Fonction pour récupérer la liste des articles ajoutés en favoris (panier)
function get_favoris_articles()
{
    // Vérifie si la session "panier" existe et si elle contient des éléments.
    //apres tableaux vide.
    if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
        return []; // Retourne un tableau vide si aucun favori n'est enregistré
    }

    $articles = []; // Initialisation du tableau des articles favoris

    // Parcourt les identifiants d'articles enregistrés dans le panier
    foreach ($_SESSION['panier'] as $id) {
        // Pour chaque identifiant, j'appelle la fonction get_article_a() pour récupérer les détails complets de l'article.
        $articles[] = get_article_a($id); // Récupère l'article correspondant à l'ID et l'ajoute au tableau
    }

    return $articles; // Retourne la liste des articles favoris
}

?>
