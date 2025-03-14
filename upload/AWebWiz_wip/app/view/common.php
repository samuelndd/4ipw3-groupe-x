<?php
function html_head($menu_a=[], $user_id="", $user_role="")
{
    $debug = false;
    ob_start();
    ?>
    <html lang="fr">
    <head>
        <title>AWebWiz Template (MVC)</title>
        <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css" />  <!-- lib externe -->
        <link rel="stylesheet" href="./css/internal/main.css" /> <!-- lib interne / perso -->
        <script
                src="https://code.jquery.com/jquery-3.4.1.js"
                integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
                crossorigin="anonymous"></script>
        <script src="./js/quirks/QuirksMode.js"></script>
        <script src="./js/internal/favorite.js"></script>
    </head>
    <body>
    <header>
        <div class="container">
            <div class="top-bar">
                <div class="top-bar-left">
                    <div class="logo"><a href="index.html"><img src="./media/newswire_logo_final.svg"></a></div>
                </div>
                <div class="top-bar-right">
                    <ul>
                        <li><a href="#"> • </a></li>
                        <li><a href="#">Questions? +1 (202) 335-3939 </a></li>
                        <li><a href="#"> • </a></li>
                        <li><a href="#">Pricing and comparison Chart </a></li>
                        <li><a href="#"> • </a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#"> • </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="button-container">
            <button class="submit-button">Submit release</button>
        </div>

        <?php
// Ton fichier CSV est ouvert et lu
$fp = fopen("menu.csv", "r");
$menu_a = [];

// Lecture du fichier ligne par ligne
while ($line = fgets($fp)) {
    $menu = explode("|", trim($line));  // On sépare chaque ligne par le caractère "|"

    // Vérification si chaque ligne contient au moins 2 éléments
    if (count($menu) < 2) {
        continue; // Si moins de 2 éléments, on ignore cette ligne
    }

    // Ajout du tableau $menu dans $menu_a
    $menu_a[] = $menu;
}

fclose($fp);

// Code pour afficher les menus (exemple de menu) :
foreach ($menu_a as $menu) {
    // Vérification du nombre d'éléments dans $menu avant de les utiliser
    if (count($menu) < 2) {
        // Si la ligne ne contient pas assez d'éléments, on passe à la suivante
        continue;
    }

    $text = $menu[0];  // Le texte du menu
    $link = $menu[1];  // Le lien du menu
    // Vérification de l'existence de l'option supplémentaire (index 2)
    $option = isset($menu[2]) ? "&name={$menu[2]}" : "";  // Si l'option existe, on l'ajoute

    // Affichage du menu (exemple)
    echo "<a href='{$link}{$option}'>{$text}</a><br>";
}
?>
    </header>
    <main>
    <?php

    if($debug) {
        echo "<pre>";
        var_dump($_COOKIE);
        var_dump($_SESSION);
        var_dump($_GET);
        var_dump($_POST);
        echo "</pre>";
    }
    return ob_get_clean();
}

function html_foot()
{
    ob_start();
    ?>
    </main>
    <footer class="footer">
        <div class="footer-section">
            <h3>Products</h3>
            <ul>
                <li><a href="#">Why Us</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Distribution</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Newsrooms</h3>
            <ul>
                <li><a href="#">All Newswires</a></li>
                <li><a href="#">World Newswires</a></li>
                <li><a href="#">US Newswires</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Help/Support</h3>
            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Video Tutorials</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>About</h3>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Career Opportunities</a></li>
                <li><a href="#">Investor Inquiries</a></li>
            </ul>
        </div>
        <div class="social-media">
            <a href="#"><img src="media/square-facebook.svg"></a>
            <a href="#"><img src="media/square-x-twitter.svg" ></a>
            <a href="#"><img src="./media/linkedin.svg"></a>
        </div>
        <hr>
        <div class="footer-copyright">
            &copy; 1995-2024 Newsmatics Inc. dba <a href="#">EIN Presswire</a> All Right Reserved.
        </div>
    </footer>
	</body>
	</html>
	<?php
	return ob_get_clean();
}

