<?php
//  Fonctions de rendu HTML pour les articles et listes d'articles

/**
 * Avec l'aide du code du prof
 * Génère le HTML pour afficher la liste de tous les articles
 *
 * @param array $article_aa Liste des articles à afficher
 * @return string Code HTML généré
 */
function html_all_articles_main(array $article_aa)
{   // Déclaration de la fonction pour afficher tous les articles
    if (empty($article_aa)) { // Si la liste d'articles est vide
        return '<p>Aucun article trouvé. Veuillez effectuer une recherche.</p>'; // Message d'absence d'articles
    }

    ob_start(); // Démarre la mise en tampon de sortie
    ?>
    <section class="press-list"> <!-- Début de la section liste de presse -->
        <?php foreach ($article_aa as $art): // Pour chaque article dans la liste ?>
            <?php
            // Définitions sécurisées avec fallback
            $id        = (int)           ($art['id']             ?? 0); // ID de l'article
            $title     =                ($art['title']          ?? ''); // Titre de l'article
            $hook      =                ($art['hook']           ?? ''); // Accroche (non utilisée)
            $content   =                ($art['content']        ?? ''); // Contenu complet
            $dateRaw   =                ($art['date_published'] ?? ''); // Date brute
            $date      = $dateRaw
                ? date('d/m/Y', strtotime($dateRaw)) // Format de la date
                : ''; // Chaîne vide si pas de date
            // Extrait de contenu
            $snippet   = substr(strip_tags($content), 0, 120) . '…'; // Premier snippet de contenu

            // Image (fallback si vide)
            $imgName   =                ($art['image_name']     ?? ''); // Nom de fichier image
            $imgPath   = $imgName
                ? MEDIA_ARTICLE_PATH . htmlspecialchars($imgName) // Chemin vers l'image
                : './media_article/default.jpg'; // Image par défaut
            ?>
            <article class="press-card"> <!-- Carte d'article -->
                <a href="?page=article&art_id=<?= $id ?>"> <!-- Lien vers la page article -->
                    <img src="<?= $imgPath ?>" alt="<?= htmlspecialchars($title) ?>"> <!-- Image de l'article -->
                    <div class="card-body"> <!-- Corps de la carte -->
                        <h5><?= htmlspecialchars($title) ?></h5> <!-- Titre de l'article -->
                        <div class="meta"><?= htmlspecialchars($date) ?></div> <!-- Date formatée -->
                        <p><?= htmlspecialchars($snippet) ?></p> <!-- Extrait de contenu -->
                    </div>
                </a> <
            </article> <!-- Fin de press-card -->
        <?php endforeach; ?>
    </section> <!-- Fin de press-list -->
    <?php
    return ob_get_clean(); // Retourne le contenu tamponné
}

/**
 * Génère les boutons pour ajouter / retirer un favori.
 *
 * @param int $id Identifiant de l'article
 * @return string HTML des boutons
 */
function html_favorite_button(int $id): string
{   // Déclaration de la fonction pour bouton favori
    ob_start(); // Démarre la mise en tampon de sortie
    ?>
    <a href="?page=panier&action=add&art_id=<?= $id ?>" class="btn btn-success">Ajouter aux favoris</a> <!-- Bouton ajouter -->
    <a href="?page=panier&action=remove&art_id=<?= $id ?>" class="btn btn-danger">Retirer des favoris</a> <!-- Bouton retirer -->
    <?php
    return ob_get_clean(); // Retourne le contenu tamponné
}

/**
 * Affiche le détail complet d’un article.
 *
 * @param array $article Données de l'article
 * @return string HTML de l'article détaillé
 */
function html_article_main(array $article): string { // Déclaration de la fonction d'affichage complet
    $id      = (int)($article['id'] ?? 0); // ID de l'article
    $title   = htmlspecialchars($article['title'] ?? ''); // Titre échappé
    $dateRaw = $article['date_published'] ?? ''; // Date brute
    $date    = $dateRaw ? date('d/m/Y', strtotime($dateRaw)) : ''; // Date formatée ou vide
    $content = $article['content'] ?? ''; // Contenu entier

    $imgName = htmlspecialchars($article['image_name'] ?? ''); // Nom de l'image échappé
    $imgPath = $imgName ? MEDIA_ARTICLE_PATH . $imgName : './media_article/default.jpg'; // Chemin image ou défaut

    $isFav = in_array($id, $_SESSION['panier'] ?? []); // Booléen si favori

    $btn = $isFav
        ? "<button class=\"favorite-btn remove remove-favorite\" data-id=\"{$id}\">" . // Bouton retirer favori
        "<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"currentColor\" viewBox=\"0 0 16 16\">" .
        "<path d=\"M8 1C4 3 1 6 1 10s3 5 7 5 7-2 7-5-3-7-7-9z\"/>" .
        "<path d=\"M8 13c-3 0-5-1-5-3s2-4 5-6c3 2 5 4 5 6s-2 3-5 3z\"/>" .
        "</svg> Retirer 💔" .
        "</button>"
        : "<button class=\"favorite-btn add add-favorite\" data-id=\"{$id}\">" . // Bouton ajouter favori
        "<svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"currentColor\" viewBox=\"0 0 16 16\">" .
        "<path d=\"M8 2.748l-.717-.737C5.6-.283 2.317 1.76 2.317 4.437c0 3.293 3.5 6.385 8 9.293 4.5-2.908 8-6 8-9.293 0-2.677-3.283-4.72-5.683-3.145L8 2.748z\"/>" .
        "</svg> Ajouter ❤️" .
        "</button>";

    return <<<HTML
<section class="article"> <!-- Début de la section article -->
    <article> <!-- Balise article -->
        <h1>{$title}</h1> <!-- Titre principal -->
        <div class="media_article"> <!-- Conteneur image -->
            <img src="{$imgPath}" alt="{$title}"> <!-- Affiche l'image -->
        </div> <!-- Fin media_article -->
        <div>{$date}</div> <!-- Date de publication -->
        <div>{$content}</div> <!-- Contenu de l'article -->
        <div>{$btn}</div> <!-- Bouton favori -->
    </article> <!-- Fin article -->
</section> <!-- Fin section article -->
HTML;
}

/**
 * Génère le HTML des détails pour l'overlay AJAX.
 */
function html_article_detail_overlay(array $article): string { // Déclaration de la fonction pour overlay detail
    $date = $article['date_published'] ? date('d/m/Y', strtotime($article['date_published'])) : ''; // Date formatée
    $category = htmlspecialchars($article['category'] ?? ''); // Catégorie échappée
    $word_count = $article['word_count'] ?? 0; // Nombre de mots
    $reading_time = $article['reading_time'] ?? 0; // Temps de lecture estimé

    ob_start(); // Démarre la mise en tampon de sortie
    ?>
    <div class="detail-content"> <!-- Conteneur des détails -->
        <p><strong>Date :</strong> <?= $date ?></p> <!-- Affiche la date -->
        <p><strong>Catégorie :</strong> <?= $category ?></p> <!-- Affiche la catégorie -->
        <p><strong>Mots :</strong> <?= $word_count ?></p> <!-- Affiche le nombre de mots -->
        <p><strong>Lecture :</strong> <?= $reading_time ?> min</p> <!-- Affiche le temps de lecture -->
    </div> <!-- Fin detail-content -->
    <?php
    return ob_get_clean(); // Retourne le contenu tamponné
} // Fin de html_article_detail_overlay
