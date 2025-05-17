<?php
function html_stats_categories_with_count($categories) {
    ob_start(); // Démarre la mise en tampon de sortie
    ?>
    <h2 class="stats-title">📊 Statistiques des catégories d’articles</h2> <!-- Titre de la section stats -->
    <table class="table-stats"> <!-- Début du tableau des statistiques -->
        <thead> <!-- En-tête du tableau -->
        <tr> <!-- Ligne d'en-tête -->
            <th>Catégorie</th> <!-- Colonne pour le nom de la catégorie -->
            <th>ID</th> <!-- Colonne pour l'identifiant de la catégorie -->
            <th>Nb d’articles</th> <!-- Colonne pour le nombre d'articles -->
        </tr>
        </thead>
        <tbody> <!-- Corps du tableau -->
        <?php foreach ($categories as $cat): ?> <!-- Boucle sur chaque catégorie -->
            <tr> <!-- Ligne pour une catégorie -->
                <td> <!-- Cellule pour le lien de la catégorie -->
                    <a class="category-pill" href="?page=press&cat_id=<?= $cat['category_id'] ?>"> <!-- Lien vers la page press filtrée par catégorie -->
                        <span class="category-icon">📁</span> <!-- Icône de dossier -->
                        <?= htmlspecialchars($cat['category_name']) ?> <!-- Nom de la catégorie échappé -->
                    </a>
                </td>
                <td class="id-cell">#<?= $cat['category_id'] ?></td> <!-- Affiche l'ID de la catégorie -->
                <td class="count-cell"><?= $cat['article_count'] ?></td> <!-- Affiche le nombre d'articles -->
            </tr> <!-- Fin de la ligne de catégorie -->
        <?php endforeach; ?> <!-- Fin de la boucle foreach -->
        </tbody>
    </table>
    <?php
    return ob_get_clean(); // Retourne le contenu tamponné et termine le buffering
}
