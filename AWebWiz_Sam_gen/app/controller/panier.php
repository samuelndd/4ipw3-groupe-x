<?php
// Contrôleur pour la gestion du panier (favoris)
require_once __DIR__ . '/../model/panier.php'; // Charge le modèle panier pour gérer les favoris
require_once __DIR__ . '/../view/panier.php'; // Charge la vue panier pour afficher le panier

function main_panier() {
    // Gestion AJAX
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) { // Vérifie si c'est une requête POST AJAX avec une action
        switch ($_POST['action']) { // Sélectionne l'action demandée
            case 'add': // Si l'action est 'add'
                add_to_favorites($_POST['art_id']); // Ajoute l'article aux favoris
                break; // Quitte le switch
            case 'remove': // Si l'action est 'remove'
                remove_from_favorites($_POST['art_id']); // Retire l'article des favoris
                break; // Quitte le switch
            case 'clear': // Si l'action est 'clear'
                clear_favorites(); // Vide tous les favoris
                break; // Quitte le switch
        } // Fin du switch
        // Renvoie le nouveau compteur
        $count = isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0; // Calcule le nombre d'articles en favoris
        header('Content-Type: application/json'); // Définit le type de contenu en JSON
        echo json_encode(['status'=>'ok','count'=>$count]); // Envoie la réponse JSON avec le statut et le compteur
        exit; // Termine l'exécution du script après la réponse AJAX
    }

    // Affichage normal
    return join("\n", [
        ctrl_head(),
        html_panier_main(get_favorites()), // Génère le contenu principal du panier avec les favoris
        html_foot()
    ]);
}
