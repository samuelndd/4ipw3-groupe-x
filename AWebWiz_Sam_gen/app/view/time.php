<?php
/**
 * Affiche le formulaire permettant de rechercher des articles par temps de lecture et nombre d'articles à afficher.
 *
 * @param int|string $min La durée de lecture saisie (minutes), si déjà renseignée.
 * @param int|string $limit Le nombre d'articles à afficher, par défaut DEFAULT_SEARCH_LIMIT.
 * @return string HTML du formulaire.
 */
function html_time_search_form($min = '', $limit = DEFAULT_SEARCH_LIMIT) {
    return <<<HTML
        <section class="time-search">
            <h2>Recherche par temps de lecture</h2>
            <form method="post">
                <label for="min">Durée de lecture :</label>
                <input name="min" id="min" type="number" value="$min" min="1">
                <!-- Champ de saisie pour définir le nombre d'articles à afficher -->
                 <button type="submit">Rechercher</button>
            </form>
        </section>
HTML;
}

/**
 * Calcule le temps de lecture estimé d'un article.
 *
 * @param string $content Le contenu HTML de l'article.
 * @return int Temps de lecture estimé en minutes (arrondi).
 */
function estimate_time($content) {
    // On retire les balises HTML pour ne compter que les mots.
    $words = str_word_count(strip_tags($content));
    // On estime environ 200 mots par minute de lecture, pris par harsard.
    $minutes = ceil($words / 200);
    return $minutes;
}

/**
 * Génère le HTML de la liste des articles avec leur temps de lecture.
 * Pour chaque article, un lien vers sa page de détail est fourni.
 *
 * @param array $articles Liste des articles à afficher.
 * @return string Code HTML généré.
 */
function html_time_list($articles) {
    ob_start(); // Démarre la capture du HTML
    ?>
    <section class="reading-time">
        <ul>
            <!-- Boucle sur chaque article pour afficher son titre et le temps de lecture estimé.
              Je me suis basé sur votre(prof) pour cette sa.-->

            <?php foreach ($articles as $article): ?>
                <li>
                    <!--Possible a accéder à la page détaillée de l'article -->
                    <strong>
                        <a href="?page=article&art_id=<?= $article['id'] ?>">
                            <?= $article['title'] ?>
                        </a>
                    </strong>
                    - Temps de lecture : <?= estimate_time($article['content']) ?> min
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <?php
    return ob_get_clean(); // Retourne le contenu HTML généré
}
?>
