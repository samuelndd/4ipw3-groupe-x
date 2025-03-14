<?php

/**
 * build <body>
 * @param $user
 * @param $role
 */
function html_panier_main()
{
    ob_start();

    $art = [];
    foreach ($_SESSION["panier"] as $id)
    {
        $art[] = get_article_a($id);
    }

    echo html_all_articles_main($art);

    return ob_get_clean();
}
