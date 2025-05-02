v<?php

/**
 * Génère la liste HTML des articles (titre, image, sommaire).
 *
 * @param array $article_aa Liste des articles
 * @return string HTML
 */
function html_all_articles_main($article_aa)
{
    ob_start();
    ?>
    <section class="other">
        <?php foreach ($article_aa as $art_a):
            $title   = htmlspecialchars($art_a['title']);
            $art_id  = (int)$art_a['id'];
            $hook    = htmlspecialchars($art_a['hook']);
            $img_src = MEDIA_ARTICLE_PATH . $art_a['image_name'];
            $summary = $hook ?: substr(strip_tags($art_a['content']), 0, 150) . '...';
            ?>
            <article>
                <a href="?page=article&art_id=<?= $art_id ?>"><h5><?= $title ?></h5></a>
                <div class="thumb">
                    <img src="<?= $img_src ?>" alt="<?= $title ?>">
                </div>
                <p><?= htmlspecialchars($summary) ?></p>
            </article>
        <?php endforeach; ?>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Boutons « favoris ».
 */
function html_favorite_button($id)
{
    ob_start();
    ?>
    <a href="?page=panier&action=add&art_id=<?= $id ?>" class="btn btn-success">Ajouter aux favoris</a>
    <a href="?page=panier&action=remove&art_id=<?= $id ?>" class="btn btn-danger">Retirer des favoris</a>
    <?php
    return ob_get_clean();
}

/**
 * Affiche le détail d’un article.
 */
function html_article_main($article_a)
{
    $title      = htmlspecialchars($article_a['title']);
    $hook       = htmlspecialchars($article_a['hook']);
    $id         = (int)$article_a['id'];
    $content    = $article_a['content'];
    $date       = htmlspecialchars($article_a['date_published']);
    $image_path = MEDIA_ARTICLE_PATH . $article_a['image_name'];

    // boutons d'ajout/retrait des favoris
    $favorite_button = html_favorite_button($id);

    return <<<HTML
<section class="article-detail">
        <article>
            <h1>$title</h1>
            <h2>$hook</h2>
            <div class="media_article">
            <img src="$image_path" alt="$title">
            </div>
            <div>$date</div>
            <div>$content</div>
            <div>$favorite_button</div>
        </article>
    </section>
HTML;
}
