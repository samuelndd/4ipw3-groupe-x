<?php
// app/model/common.php : Fonctions communes du modèle

function get_menu_csv(): array
{
    $fn = __DIR__ . '/../../asset/database/menu.csv'; // Chemin vers le fichier CSV du menu
    $lines = file($fn, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // Lit le fichier en ignorant les lignes vides

    $menu_a = []; // Initialise le tableau qui contiendra les éléments du menu

    foreach ($lines as $line) { // Parcourt chaque ligne du CSV
        $line = trim($line); // Supprime les espaces en début et fin de ligne
        if ($line === '') continue; // Ignore les lignes vides

        $parts = explode('|', $line); // Sépare la ligne en colonnes selon le caractère '|'

        if (count($parts) >= 2) { // Vérifie qu'il y a au moins deux colonnes
            // Je récupère les colonnes du CSV
            $text = $parts[0]; // Texte à afficher pour l'élément de menu
            $link = $parts[1]; // URL ou chemin du lien
            $role = $parts[2] ?? 'public'; // Rôle requis, ou 'public' par défaut
            $name = $parts[3] ?? ''; // Nom optionnel de l'élément de menu

            // Je stocke proprement dans un tableau associatif
            $menu_a[] = [ // Ajoute un tableau associatif pour chaque élément
                'text' => trim($text), // Nettoie et assigne le texte
                'link' => trim($link), // Nettoie et assigne le lien
                'role' => trim($role), // Nettoie et assigne le rôle
                'name' => trim($name)  // Nettoie et assigne le nom
            ];
        }
    }

    return $menu_a; // Retourne le tableau complet du menu
}


/**
 * retourne l'objet PDO
 * crée l'objet PDO s'il n'existe pas
 */
function get_pdo() // Déclaration de la fonction pour obtenir l'instance PDO
{   // Début de get_pdo
    static $pdo; // Variable statique pour stocker l'instance unique

    if (empty($pdo)) // Si aucune instance PDO n'existe encore
    {   // Début de l'initialisation
        $pdo = new PDO(DATABASE_DSN, DATABASE_USERNAME, DATABASE_PASSWORD); // Crée une nouvelle instance PDO
        $pdo->query("SET NAMES UTF8"); // Définit l'encodage des caractères en UTF-8
    }

    return $pdo; // Retourne l'instance PDO existante ou nouvellement créée
}
