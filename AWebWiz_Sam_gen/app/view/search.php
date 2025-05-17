<?php
function html_search_page($kw = '', $lim = DEFAULT_SEARCH_LIMIT, $date_min = '', $date_max = '', $articles = [], $reading_time = '') // Déclare la fonction html_search_page avec ses paramètres
{ // Début de la fonction html_search_page
    return <<<HTML
    <section class="search-form-container"> <!-- Conteneur du formulaire de recherche -->
        <h2>Recherche d'articles</h2> <!-- Titre de la section de recherche -->
        <form method="post" class="search-form"> <!-- Formulaire de recherche -->
            <div class="form-group"> <!-- Groupe pour le champ mot-clé -->
                <label for="search_kw">Mot-clé :</label> <!-- Label pour le champ mot-clé -->
                <input id="search_kw" name="search_kw" type="text" value="$kw" placeholder="Entrez un mot-clé"> <!-- Input texte pour le mot-clé avec valeur par défaut -->
            </div>

            <div class="form-group"> <!-- Groupe pour le nombre de résultats -->
                <label for="search_limit">Nombre de résultats :</label> <!-- Label pour le champ limite -->
                <input id="search_limit" name="search_limit" type="number" value="$lim" min="1" max="100"> <!-- Input numérique pour la limite de résultats -->
            </div> 

            <div class="form-group"> <!-- Groupe pour la date minimale -->
                <label for="search_date_min">Date minimale :</label> <!-- Label pour la date minimale -->
                <input id="search_date_min" name="search_date_min" type="date" value="$date_min"> <!-- Input date pour filtrer la date minimale -->
            </div> 

            <div class="form-group"> <!-- Groupe pour la date maximale -->
                <label for="search_date_max">Date maximale :</label> <!-- Label pour la date maximale -->
                <input id="search_date_max" name="search_date_max" type="date" value="$date_max"> <!-- Input date pour filtrer la date maximale -->
            </div> 

            <div class="form-group"> <!-- Groupe pour le temps de lecture -->
                <label for="search_reading_time">Temps de lecture maximum (en min) :</label> <!-- Label pour le slider de temps de lecture -->
                <input type="range" id="search_reading_time" name="search_reading_time" min="1" max="30" value="$reading_time" oninput="document.getElementById('readingVal').innerText = this.value"> <!-- Slider pour sélectionner le temps de lecture -->
                <span id="readingVal">$reading_time</span> min <!-- Affiche la valeur actuelle du slider -->
            </div> 

            <button type="submit" class="btn btn-primary">Rechercher</button> <!-- Bouton de soumission du formulaire -->
        </form> 
    </section> 

    <!-- Zone pour les résultats -->
    <section class="search-results-container mt-4"> <!-- Conteneur pour afficher les résultats -->
HTML
        . (!empty($articles) ? html_all_articles_main($articles) : '') // Affiche les résultats ou rien
        . <<<HTML
    </section> <!-- Fin de la section search-results-container -->
HTML;
} // Fin de la fonction html_search_page
