<?php
//  Fonctions pour gérer les favoris dans la session
require_once __DIR__ . '/article.php'; // Charge le modèle article pour récupérer les données des articles

function add_to_favorites($art_id) { // Ajoute un article aux favoris
    if (!isset($_SESSION['panier'])) { // Si le panier n'existe pas en session
        $_SESSION['panier'] = []; // Initialise le panier comme tableau vide
    } // Fin de l'initialisation du panier
    if (!in_array($art_id, $_SESSION['panier'])) { // Si l'article n'est pas déjà dans le panier
        $_SESSION['panier'][] = $art_id; // Ajoute l'ID de l'article aux favoris
    }
}

function remove_from_favorites($art_id) { // Retire un article des favoris
    if (isset($_SESSION['panier'])) { // Si le panier existe en session
        $_SESSION['panier'] = array_filter( // Filtre le tableau pour supprimer l'article
            $_SESSION['panier'], // Tableau des IDs en session
            function($id) use ($art_id) { // Fonction anonyme pour comparer les IDs
                return $id != $art_id; // Conserve les IDs différents de celui à supprimer
            }
        );
    }
}

function clear_favorites() { // Vide tous les favoris
    unset($_SESSION['panier']); // Supprime la variable panier de la session
}

function get_favorites(): array { // Récupère la liste des articles favoris
    if (empty($_SESSION['panier'])) { // Si aucun favori en session
        return []; // Retourne un tableau vide
    }
    return array_map('get_article_a', $_SESSION['panier']); // Mappe chaque ID à l'article correspondant
}
