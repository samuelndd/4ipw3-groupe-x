<?php
require_once '../app/view/article.php'; // Charge la vue article pour accéder à MEDIA_ARTICLE_PATH

/**
 * @param array $featured  L'article mis en avant
 * @param array $articles  Les autres articles
 */
function html_home_main(array $featured, array $articles): string // Déclaration de la fonction html_home_main
{   // Début de html_home_main
    ob_start(); // Démarre la mise en tampon de sortie
    ?>
    <section class="featured"> <!-- Section pour l'article mis en avant -->
        <article> <!-- Balise article -->
            <a href="?page=article&art_id=<?= $featured['id'] ?>"> <!-- Lien vers l'article mis en avant -->
                <img src="<?= MEDIA_ARTICLE_PATH . ($featured['image_name']) ?>" <!-- Affiche l'image de l'article -->
                alt="<?= ($featured['title']) ?>"> <!-- Texte alternatif de l'image -->
                <h1><?= ($featured['title']) ?></h1> <!-- Titre principal de l'article -->
                <p><?= nl2br(($featured['hook'])) ?></p> <!-- Accroche de l'article avec retours à la ligne -->
            </a>
        </article>
    </section>

    <section class="other"> <!-- Section pour les autres articles -->
        <?php foreach ($articles as $art): ?> <!-- Boucle sur chaque article secondaire -->
            <article> <!-- Balise article pour chaque article secondaire -->
                <a href="?page=article&art_id=<?= $art['id'] ?>"> <!-- Lien vers l'article secondaire -->
                    <div class="thumb"> <!-- Conteneur de la miniature -->
                        <img src="<?= MEDIA_ARTICLE_PATH . ($art['image_name']) ?>" <!-- Affiche l'image miniature -->
                        alt="<?= ($art['title']) ?>"> <!-- Texte alternatif de la miniature -->
                    </div>
                    <h3><?= ($art['title']) ?></h3> <!-- Titre secondaire -->
                    <p><?= nl2br(($art['hook'])) ?></p> <!-- Accroche secondaire avec retours à la ligne -->
                </a>
            </article>
        <?php endforeach; ?>
    </section>
    <?php
    return ob_get_clean(); // Retourne le contenu tamponné et termine le buffering
}
