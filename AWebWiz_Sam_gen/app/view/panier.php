<?php
// Elle me permet d'utiliser la fonction get_favoris_articles() définie dans le modèle.
require_once '../app/model/panier.php'; // Charge le modèle panier pour gérer les favoris

/**
 * Génère le HTML pour afficher la liste des articles favoris
 *
 * @return string Code HTML affichant les articles favoris
 */
function html_panier_main(array $articles) {
    if (empty($articles)) { // Si le tableau d'articles est vide
        return "<p>Votre liste de favoris est vide.</p>"; // Retourne un message indiquant qu'il n'y a pas de favoris
    }

    ob_start(); // Démarre la mise en tampon de sortie
    ?>
    <section class="favorites"> <!-- Section principale des favoris -->
        <h2>Vos Favoris (<?= count($articles) ?>)</h2> <!-- Titre avec le nombre de favoris -->
        <button id="clear-favorites" class="clear-favorites-btn"> <!-- Bouton pour vider la liste -->
            Vider la liste
        </button>
        <table class="table table-striped"> <!-- Table Bootstrap pour lister les favoris -->
            <thead> <!-- En-tête du tableau -->
            <tr> <!-- Ligne d'en-tête -->
                <th>Image</th> <!-- Colonne Image -->
                <th>Titre</th> <!-- Colonne Titre -->
                <th>Date</th> <!-- Colonne Date -->
                <th>Action</th> <!-- Colonne Action -->
            </tr>
            </thead>
            <tbody> <!-- Début du corps du tableau -->
            <?php foreach ($articles as $art): ?> <!-- Pour chaque article favori -->
                <tr> <!-- Ligne pour un favori -->
                    <td> <!-- Cellule pour l'image -->
                        <img src="<?= MEDIA_ARTICLE_PATH . htmlspecialchars($art['image_name']) ?>" alt="<?= htmlspecialchars($art['title']) ?>" style="width: 50px; height: auto;"> <!-- Miniature de l'article -->
                    </td>
                    <td><?= htmlspecialchars($art['title']) ?></td> <!-- Cellule pour le titre -->
                    <td><?= date('d/m/Y', strtotime($art['date_published'])) ?></td> <!-- Cellule pour la date formatée -->
                    <td> <!-- Cellule pour l'action -->
                        <button class="favorite-btn remove remove-favorite" data-id="<?= $art['id'] ?>"> <!-- Bouton pour retirer des favoris -->
                            Retirer 💔 <!-- Texte du bouton -->
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <?php
    return ob_get_clean();
}
