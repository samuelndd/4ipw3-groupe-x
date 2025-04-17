<?php

//Elle me permet d'utiliser la fonction get_favoris_articles() définie dans le modèle.
require_once '../app/model/panier.php';

/**
 * Génère le HTML pour afficher la liste des articles favoris
 *
 * @return string Code HTML affichant les articles favoris
 */
function html_panier_main()
{
    // Récupère la liste des articles favoris enregistrés dans la session
    $articles = get_favoris_articles();

    // Vérifie si la liste des favoris est vide
    if (empty($articles)) {
        return "<p>Votre liste de favoris est vide.</p>";//messsager qui di que c'est vide
    }

    ob_start(); // Démarre la mise en mémoire tampon.
    //Affiche le nombre total d’articles.
    ?>
    <section class="favorites">
        <h2>Vos Articles Favoris (<?= count($articles) ?>)</h2>
        <?php foreach ($articles as $article): ?> <!-- Boucle à travers les articles favoris -->
            <article>
                <h3><?= $article['title'] ?></h3> <!-- Affiche le titre de l'article -->
                <p><?= $article['hook'] ?></p> <!-- Affiche l'accroche de l'article -->
                <a href="?page=article&art_id=<?= $article['id'] ?>">Voir l'article</a> <!-- Lien vers l'article -->
                <a href="?page=panier&action=remove&art_id=<?= $article['id'] ?>" class="btn btn-danger">Retirer</a> <!-- Bouton de suppression des favoris -->
            </article>
        <?php endforeach; ?>
    </section>
    <?php
    return ob_get_clean(); // Récupère et retourne le contenu mis en mémoire tampon.
}

?>
