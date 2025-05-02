<?php
require_once '../app/view/article.php';

/**
 *  Génère le contenu principal de la page d'accueil.
 * build <body>
 * @param $user
 * @param $role
 */

function html_home_main(array $featured, array $all): string
{
    // Je récupère le titre, l'accroche et l'ID de l'article principal.
    // copie de html_article_main, mais en version « featured »
    $id       = (int)$featured['id'];
    $title    = htmlspecialchars($featured['title']);
    $hook     = htmlspecialchars($featured['hook']);
    $img_src  = MEDIA_ARTICLE_PATH . $featured['image_name'];
    $summary  = $hook ?: substr(strip_tags($featured['content']), 0, 150) . '...';

    ob_start();
    ?>
    <section class="breaking">
        <article>
            <!-- Affichage du titre de l'article principal avec un lien vers la page de détail -->
            <a href="?page=article&art_id=<?= $id ?>"><h1><?= $title ?></h1></a>
            <!-- Affichage de l'accroche de l'article principal -->
            <h2><?=$hook?></h2>
            <div class="media_article"><img src="<?= $img_src ?>" alt="<?= $title ?>"></div>
            <p><?=htmlspecialchars($summary)?></p>
        </article>
    </section>

    <!-- ce conteneur sera rempli par AJAX -->
    <section id="home-articles" class="other"></section>
    <?php
    return ob_get_clean();
}