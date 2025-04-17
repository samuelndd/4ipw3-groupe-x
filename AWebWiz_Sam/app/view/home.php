<?php
require_once '../app/view/article.php';

/**
 *  Génère le contenu principal de la page d'accueil.
 * build <body>
 * @param $user
 * @param $role
 */

function html_home_main($article_a, $bottom_article_a)
{
    // Je récupère le titre, l'accroche et l'ID de l'article principal.
    $title = $article_a['title'];
    $hook = $article_a['hook'];
    $art_id = $article_a['id'];

    ob_start();
    ?>
    <section class="breaking">
        <article>
            <!-- Affichage du titre de l'article principal avec un lien vers la page de détail -->
            <a href="?page=article&art_id=<?=$art_id?>"><h1><?=$title?></h1></a>
            <!-- Affichage de l'accroche de l'article principal -->
            <h2><?=$hook?></h2>
        </article>
    </section>
    <?php
    // Appeler html_all_articles_main pour afficher les autres articles
    echo html_all_articles_main($bottom_article_a);
    return ob_get_clean();
}