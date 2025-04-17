<?php

/**
 * Avec l'aide du code du prof
 * Génère le HTML pour afficher la liste de tous les articles
 *
 * @param array $article_aa Liste des articles à afficher
 * @return string Code HTML généré
 */
function html_all_articles_main($article_aa)
{
    ob_start(); // Démarre la mise en mémoire tampon de sortie
    ?>
    <section class="other">
        <?php
        // Boucle à travers tous les articles passés en paramètre.
        foreach ($article_aa as $art_a) {
            $title = $art_a['title']; // Récupère le titre de l'article.
            $art_id = $art_a['id']; // Récupère l'ID de l'article avec un lien créer.

            // Génère un bloc HTML pour chaque article
            //Me perme de affiche les articles dans accueil press et recherche
            echo <<< HTML
                <article>
                    <a href="?page=article&art_id=$art_id"><h5>$title</h5></a>
                </article>
            HTML;
        }
        ?>
    </section>
    <?php
    return ob_get_clean(); // Récupère et retourne le contenu mis en mémoire tampon
}

/**
 * Génère les boutons pour ajouter ou retirer un article des favoris
 *
 * @param int $id ID de l'article
 * @return string Code HTML des boutons d'ajout/suppression des favoris
 */
function html_favorite_button($id)
{
    ob_start(); // Démarre la mise en mémoire tampon de sortie
    ?>
    <a href="?page=panier&action=add&art_id=<?= $id ?>" class="btn btn-success">Ajouter aux favoris</a>
    <a href="?page=panier&action=remove&art_id=<?= $id ?>" class="btn btn-danger">Retirer des favoris</a>
    <?php
    return ob_get_clean(); // Récupère et retourne le contenu mis en mémoire tampon
}

/**
 *  Avec l'aide du code du prof
 * Génère le HTML pour afficher un article en détail
 *
 * @param array $article_a Données de l'article à afficher
 * @return string Code HTML de l'article détaillé
 */
function html_article_main($article_a)
{
    // Récupération des informations de l'article.
    $title = $article_a['title']; //Titre de l'article.
    $hook = $article_a['hook']; //L'accroche (petite description).
    $id = $article_a['id']; //L'ID de l'article, utilisé pour les actions .
    $content = $article_a['content']; //Le contenu de complet de l'article.
    $date = $article_a['date_published']; //Date de publication.
    $image_path = MEDIA_ARTICLE_PATH . $article_a['image_name']; // Construit le chemin de l'image.

    // Génère les boutons d'ajout/retrait des favoris.
    //Grace a la fonction html_favorite_button.
    $favorite_button = html_favorite_button($id);

    // Génère et retourne le code HTML complet de l'article.
    //Structuration de la page de l'article avec toutes les informations importantes.
    return <<<HTML
    <section class="article">
        <article>
            <h1>$title</h1>
            <h2>$hook</h2>
            <div class="media_article"><img src="$image_path" alt="$title"></div>
            <div>$date</div>
            <div>$content</div>
            <div>$favorite_button</div> <!-- Ajoute les boutons de favoris -->
        </article>
    </section>
HTML;
}

?>
