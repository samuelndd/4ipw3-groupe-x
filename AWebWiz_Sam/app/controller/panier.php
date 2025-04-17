<?php
require_once '../app/view/panier.php';
require_once '../app/model/article.php';
function main_panier()
{
    // Vérifie si la session panier existe, sinon initialise comme un tableau vide
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
// Gérer l'ajout et la suppression des favoris
    if (isset($_GET['action']) && isset($_GET['art_id'])) {
        $art_id = $_GET['art_id']; // Récupération de l'identifiant de l'article
// l'action "add", ajoute l'article au panier s'il n'y est pas déjà
        // Vérifie si l'article est déjà dans le panier, avec in_array
        if ($_GET['action'] == 'add' && !in_array($art_id, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $art_id;
        }
// Si l'action est "remove", supprime l'article du panier
        // Utilise array_filter pour filtrer l'id qui nous intéresse et le retirer
        if ($_GET['action'] == 'remove') {
            $_SESSION['panier'] = array_filter($_SESSION['panier'], function ($id) use ($art_id) {
                return $id != $art_id; // Filtre pour retirer l'article correspondant
            });
        }
    }
// Retourne la structure HTML du panier avec l'affichage des favoris
    return join("\n", [
        ctrl_head(), // Affichage de l'en-tête
        html_panier_main(), // Affichage du contenu principal du panier
        html_foot(), // Affichage du pied de page
    ]);
}
?>
