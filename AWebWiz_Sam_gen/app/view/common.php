<?php
function html_head(array $menu_a = [], string $user_id = "", string $user_role = "", $font = null, $bg_color = null, string $current_url = 'index.php?page=home', $border = null)
{   // Déclaration de la fonction html_head avec ses paramètres
if (!empty($_GET['ajax'])) { // Si la requête est AJAX
    return ''; // Ne renvoie rien pour AJAX
}
$debug = false; // Variable de debug, désactivée par défaut
ob_start(); // Démarre le tampon de sortie
?>
    <!doctype html> <!-- Déclaration du doctype HTML -->
<html lang="fr"> <!-- Début de la balise HTML avec attribut de langue -->
<head> <!-- Début de la section head -->
    <meta charset="UTF-8"> <!-- Définition de l'encodage des caractères -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Adaptation responsive -->
    <title>Mon Site MVC</title> <!-- Titre de la page -->

    <!-- Bootstrap et styles internes -->
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css" /> <!-- Feuille de style Bootstrap -->
    <link rel="stylesheet" href="./css/internal/star.css" /> <!-- Style pour les étoiles -->
    <link rel="stylesheet" href="./css/internal/main.css" /> <!-- Style principal interne -->
    <link rel="stylesheet" href="./css/internal/sponsor.css" /> <!-- Style pour les sponsors -->
    <!-- CSS “Le Monde” + centrage -->
    <link rel="stylesheet" href="./css/internal/lemonde.css" /> <!-- Style inspiré du Monde -->
    <link rel="stylesheet" href="./css/internal/login.css" /> <!-- Style de la page de login -->
    <link rel="stylesheet" href="./css/internal/detail.css" /> <!-- Style des détails d'article -->
    <link rel="stylesheet" href="./css/internal/fav.css" /> <!-- Style des favoris -->
    <link rel="stylesheet" href="./css/internal/stats.css" /> <!-- Style de la page statistiques -->

    <script src="./js/vendor/jQuery-3.7.1.min.js"></script> <!-- Chargement de jQuery -->
    <script>var AJAX_ENABLED = <?= AJAX_ENABLED ? 'true' : 'false'; ?>;</script> <!-- Variable JS indiquant si AJAX est activé -->
    <script src="./js/internal/spa.js"></script> <!-- Script SPA interne -->
    <script src="./js/internal/star.js"></script> <!-- Script pour les étoiles -->
    <script src="./js/internal/detail.js"></script> <!-- Script pour le détail AJAX -->
    <script src="./js/internal/search.js"></script> <!-- Script pour la recherche -->


    <?php
    // Styles dynamiques (police, fond, bordure)
    if ($font)     echo "<style>body { font-family: $font !important; }</style>"; // Applique la police si définie
    if ($bg_color) echo "<style>body { background-color: $bg_color !important; }</style>"; // Applique la couleur de fond
    if ($border) { // Si un style de bordure est défini
        $bs = $border==='thin'  ? '1px solid black' // Bordure fine
            : ($border==='thick'? '3px solid black' // Bordure épaisse
                : ''); // Sinon vide
        if ($bs) echo "<style>body { border: $bs !important; }</style>"; // Applique la bordure
    }
    ?>
</head> <!-- Fin de la section head -->
<body> <!-- Début du body -->

<header> <!-- Début de l'en-tête -->
    <div class="container"> <!-- Conteneur de Bootstrap -->
        <div class="top-bar d-flex justify-content-between align-items-center py-2"> <!-- Barre supérieure -->
            <div class="logo"> <!-- Logo du site -->
                <a href="index.php"><img src="./media/Le_Monde.svg.png" alt="Logo"></a> <!-- Lien vers la page d'accueil -->
            </div> <!-- Fin logo -->
            <div class="top-bar-right d-flex align-items-center"> <!-- Partie droite de la top-bar -->
                <?php if (isset($_SESSION['user'])): ?> <!-- Si l'utilisateur est connecté -->
                    <span class="user-info me-3"> <!-- Affiche les infos utilisateur -->
            Connecté en tant que <?= htmlspecialchars($_SESSION['user']) ?> <!-- Nom de l'utilisateur -->
          </span>
                <?php endif; ?> <!-- Fin affichage info utilisateur -->
                <?php if (isset($_SESSION['user'])): ?> <!-- Si connecté, affiche le formulaire de style -->
                    <form id="style-form" method="post" action="?page=font" class="d-flex gap-2 align-items-center"> <!-- Formulaire de style -->
                        <label for="font" class="mb-0">Police :</label> <!-- Label pour police -->
                        <?= get_font_dropdown() ?> <!-- Dropdown police -->
                        <label for="border" class="mb-0">Bordure :</label> <!-- Label pour bordure -->
                        <?= get_border_dropdown() ?> <!-- Dropdown bordure -->
                        <label for="font_size" class="mb-0">Taille :</label> <!-- Label pour taille de police -->
                        <select id="font_size" name="font_size" class="form-select form-select-sm"> <!-- Dropdown taille -->
                            <option value="">Défaut</option> <!-- Option défaut -->
                            <option value="14">14 px</option> <!-- Option 14px -->
                            <option value="16">16 px</option> <!-- Option 16px -->
                            <option value="18">18 px</option> <!-- Option 18px -->
                        </select> <!-- Fin dropdown taille -->
                        <label for="theme" class="mb-0">Thème :</label> <!-- Label pour thème -->
                        <select id="theme" name="theme" class="form-select form-select-sm"> <!-- Dropdown thème -->
                            <option value="">Défaut</option> <!-- Thème défaut -->
                            <option value="yellow">Jaune</option> <!-- Thème jaune -->
                            <option value="rose">Rose</option> <!-- Thème rose -->
                            <option value="blue">Bleu</option> <!-- Thème bleu -->
                        </select> <!-- Fin dropdown thème -->
                        <input type="hidden" name="current_url" value="<?= htmlspecialchars($current_url) ?>"> <!-- Champ caché pour URL courante -->
                    </form> <!-- Fin formulaire style -->
                <?php endif; ?> <!-- Fin test utilisateur connecté -->
            </div> <!-- Fin top-bar-right -->
        </div> <!-- Fin top-bar -->

        <!-- Menu SPA -->
        <nav id="menu" class="lm-nav-main mb-4"> <!-- Début du menu principal -->
            <?php foreach ($menu_a as $menu): ?> <!-- Pour chaque élément du menu -->
                <?php
                $text = htmlspecialchars($menu['text']); // Texte du lien
                $link = htmlspecialchars($menu['link']); // URL du lien
                $opt  = ($link === 'static' && !empty($menu['name']))
                    ? '&name=' . urlencode($menu['name']) // Ajoute paramètre name si page static
                    : '';
                ?>

                <?php if ($link === 'panier'): ?> <!-- Si le lien mène au panier -->
                    <?php $cnt = count($_SESSION['panier'] ?? []); // Compte des items dans le panier ?>
                    <a id="fav-link" href="?page=panier<?= $opt ?>"> <!-- Lien vers le panier -->
                        <?= $text ?> (<?= $cnt ?>) <!-- Texte du lien avec compteur -->
                    </a> |
                <?php else: ?> <!-- Sinon lien normal -->
                    <a href="?page=<?= $link ?><?= $opt ?>"> <!-- Lien vers la page -->
                        <?= $text ?> <!-- Texte du lien -->
                    </a> |
                <?php endif; ?> <!-- Fin du test panier -->
            <?php endforeach; ?> <!-- Fin boucle menu -->
        </nav> <!-- Fin menu -->


    </div> <!-- Fin container -->
</header> <!-- Fin header -->

<main  id="content"> <!-- Début du contenu principal -->
    <?php
    if ($debug) { // Si debug activé
        echo '<pre>'; // Ouvre un bloc préformaté
        var_dump($_COOKIE, $_SESSION, $_GET, $_POST); // Affiche les superglobales
        echo '</pre>'; // Ferme le bloc préformaté
    } // Fin du debug
    return ob_get_clean(); // Retourne tout le HTML capturé
    }
    // Fonction pour générer le pied de page
    function html_foot(): string
    {   // Déclaration de html_foot
    // Si c'est une requête AJAX → on ne retourne PAS le footer
    if (!empty($_GET['ajax'])) { // Test AJAX pour le footer
        return ''; // Ne renvoie rien
    } // Fin test AJAX footer

    // Log pour débug : affichera dans error_log si ça s'appelle
    error_log('>>> html_foot() appelé <<<'); // Trace l'appel dans le log

    // On utilise output buffering pour capturer le HTML
    ob_start(); // Démarre le tampon de sortie
    ?>
</main> <!-- Fin main -->

<footer class="lm-footer mt-5"> <!-- Début du footer -->
    <div class="container"> <!-- Conteneur de Bootstrap -->
        <div class="row lm-footer-top py-4"> <!-- Ligne supérieure du footer -->
            <!-- Première colonne -->
            <div class="col-md-3 lm-footer-col"> <!-- Colonne 1 -->
                <h4>À LA UNE</h4> <!-- Titre de la section -->
                <ul> <!-- Liste de liens -->
                    <li><a href="#">Dernières actualités</a></li> <!-- Lien actualités -->
                    <li><a href="#">Édition abonnés</a></li> <!-- Lien abonnés -->
                    <li><a href="#">Le Live</a></li> <!-- Lien live -->
                </ul> <!-- Fin liste -->
            </div> <!-- Fin colonne 1 -->
            <!-- Deuxième colonne -->
            <div class="col-md-3 lm-footer-col"> <!-- Colonne 2 -->
                <h4>INTERNATIONAL</h4> <!-- Titre -->
                <ul>
                    <li><a href="#">Europe</a></li>
                    <li><a href="#">États-Unis</a></li>
                    <li><a href="#">Asie</a></li>
                </ul>
            </div> <!-- Fin colonne 2 -->
            <!-- Troisième colonne -->
            <div class="col-md-3 lm-footer-col"> <!-- Colonne 3 -->
                <h4>CULTURE</h4>
                <ul>
                    <li><a href="#">Arts</a></li>
                    <li><a href="#">Scènes</a></li>
                    <li><a href="#">Livres</a></li>
                </ul>
            </div> <!-- Fin colonne 3 -->
            <!-- Quatrième colonne -->
            <div class="col-md-3 lm-footer-col"> <!-- Colonne 4 -->
                <h4>PLUS</h4>
                <ul>
                    <li><a href="#">Météo</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Annonces</a></li>
                </ul>
            </div> <!-- Fin colonne 4 -->
        </div> <!-- Fin row footer-top -->

        <!-- Sponsor : placé ici et chargé dynamiquement -->
        <?php
        require_once '../app/model/sponsor.php'; // Charge le modèle sponsor
        require_once '../app/view/sponsor.php';    // Charge la vue sponsor
        echo html_banner(get_sponsor_content()); // Affiche la bannière sponsor
        ?>

        <div class="lm-footer-bottom py-3 d-flex justify-content-between align-items-center border-top"> <!-- Bas du footer -->
            <ul class="lm-legal list-unstyled d-flex gap-3 mb-0"> <!-- Liens légaux -->
                <li>Mentions légales</li>
                <li>CGU</li>
                <li>Politique de confidentialité</li>
                <li>Cookies</li>
            </ul> <!-- Fin liste légale -->
            <p class="mb-0">&copy; <?= date('Y') ?> Mon Site MVC — Inspiré par Le Monde</p> <!-- Copyright dynamique -->
        </div> <!-- Fin footer-bottom -->
    </div> <!-- Fin container -->
</footer> <!-- Fin footer -->

</body> <!-- Fin body -->
</html> <!-- Fin HTML -->
<?php
// On retourne tout le HTML capturé proprement
return ob_get_clean(); // Retourne le contenu tamponné final
}

?>
