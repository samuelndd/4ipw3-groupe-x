<?php
require_once '../app/view/search.php'; // Charge la vue search pour afficher le formulaire et résultats

function main_search()
{   // Début de main_search
    require_once __DIR__ . '/../view/search.php';  // Recharge la vue search (au cas où)
    require_once __DIR__ . '/../model/article.php'; // Charge le modèle article pour les fonctions de recherche

    $kw = $_POST['search_kw'] ?? '';           // Mot-clé de recherche récupéré depuis POST ou vide
    $limit = $_POST['search_limit'] ?? DEFAULT_SEARCH_LIMIT; // Nombre max d'articles ou valeur par défaut
    $date_min = $_POST['search_date_min'] ?? ''; // Date minimum de publication ou vide
    $date_max = $_POST['search_date_max'] ?? ''; // Date maximum de publication ou vide
    $reading_time = $_POST['search_reading_time'] ?? ''; // Temps de lecture max sélectionné ou vide

    $all_article_a = []; // Initialise le tableau des articles trouvés

    // Si requête POST avec au moins un critère de recherche
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!empty($kw) || !empty($date_min) || !empty($date_max) || !empty($reading_time))) {
        $all_article_a = get_all_article_a($kw, $limit, $date_min, $date_max); // Récupère les articles selon les filtres

        // Filtrer par temps de lecture max
        if (!empty($reading_time)) { // Si un temps de lecture max est défini
            $all_article_a = array_filter($all_article_a, function($art) use ($reading_time) { // Applique un filtre sur chaque article
                $est_time = ceil(str_word_count(strip_tags($art['content'])) / 200); // Calcule le temps de lecture estimé
                return $est_time <= $reading_time; // Garde l'article si son temps de lecture est inférieur ou égal
            });
        }
    }

    // Gestion des requêtes AJAX
    if (!empty($_GET['ajax'])) { // Si paramètre ajax présent
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Pour requête POST AJAX
            return !empty($all_article_a)
                ? html_all_articles_main($all_article_a) // Retourne la liste d'articles en HTML
                : '<p>Aucun article trouvé.</p>';       // Ou message si aucune correspondance
        }

        return html_search_page($kw, $limit, $date_min, $date_max, [], $reading_time); // Pour GET AJAX, retourne le formulaire sans résultats
    }

    // Affichage normal de la page de recherche
    return join("\n", [
        ctrl_head(),
        html_search_page($kw, $limit, $date_min, $date_max, $all_article_a, $reading_time), // Génère le contenu de la page de recherche
        html_foot(),
    ]);
}