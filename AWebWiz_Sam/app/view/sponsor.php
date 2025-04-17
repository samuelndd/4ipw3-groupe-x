<?php

/**
 * Affiche une bannière sponsor à partir des données JSON
 * @param array $data Données de la bannière
 * @return string HTML
 */
function html_banner($data)
{
    //récupèration du texte depuis les données JSON.
    // nl2br() transforme les \n en <br> pour garder les retours à la ligne.
    $text = nl2br($data['text'] ?? '');

    //récupèration de la couleur principale
    $color = $data['color'] ?? '#ffffff';

    // récupèration de l’image principale
    $image = $data['image'] ?? '';

    // récupèration de l’image secondaire
    $background = $data['background_image'] ?? '';

    // récupèration du lien vers le site du sponsor
    $link = $data['link'] ?? '#';

    // ob_start() démarre une "capture" de tout le HTML généré ci-dessous
    // Cela permet de le stocker dans une variable pour le retourner à la fin

    ob_start(); ?>
    <section class="sponsor-banner" style="--sponsor-color: <?= $color ?>; --sponsor-bg: url('<?= $background ?>');">
        <div class="sponsor-gauche">
            <h2>Sponsor</h2>
            <!-- J'affiche le texte fourni, en conservant les retours à la ligne grâce à nl2br -->
            <p><?= $text ?></p>
        </div>
        <div class="sponsor-droite">
            <?php if ($image): ?>
                <!-- Si une image est fournie, j'affiche un lien  qui renvoie vers le site du sponsor -->
                <a href="<?= $link ?>" target="_blank">
                    <img src="<?= $image ?>" alt="Image sponsor 1">
                </a>
            <?php endif; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
