<?php
require_once '../app/controller/buttons.php';

//Reçoit en paramètres un tableau pour le menu et des informations sur l'utilisateur
function html_head($menu_a = [],$user_id = "", $user_role = "", $font = null, $bg_color = null, $current_url = 'index.php?page=home', $border = null) {
$debug = false;
ob_start();//La mise en mémoire tampon.
?>
<html lang="fr">
<head>
    <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/internal/main.css" />
    <link rel="stylesheet" href="./css/internal/sponsor.css" />
    <link rel="stylesheet" href="./css/internal/main.css" />
    <script src="./js/quirks/QuirksMode.js"></script>
    <?php
    // Applique la police choisie par l'utilisateur
    if ($font) {
        echo "<style>body { font-family: $font; }</style>";
    }
    // Applique la couleur de fond choisie par l'utilisateur
    if ($bg_color) {
        echo "<style>body { background-color: $bg_color; }</style>";
    }
    // Applique la bordure choisie par l'utilisateur.
    if ($border) {
        $borderStyle = "";
        //Definition des bordures.
        switch ($border) {
            case "thin":
                $borderStyle = "1px solid black";
                break;
            case "thick":
                $borderStyle = "3px solid black";
                break;
        }
        if ($borderStyle) {
            echo "<style>body { border: $borderStyle; }</style>";
        }
    }
    ?>
</head>
<body>
<header>
    <div class="container">
        <div class="top-bar">
            <div class="top-bar-left">
                <div class="logo"><a href="index.html"><img src="./media/Le_Monde.svg.png" class=" mb-3 " ></a></div>
            </div>
        </div>
    </div>

    <!-- Formulaire regroupant les options de police, couleur et bordur
    //permet à l'utilisateur de personnaliser l'apparence du site-->
    <form method="post" action="?page=font">
        <label for="font">Police :</label>
        <?php echo get_font_dropdown(); ?>
        <button type="submit">Ok</button>

        <label for="bg_color">Couleur :</label>
        <?php echo get_bg_color_dropdown(); ?>
        <button type="submit">Ok</button>

        <label for="border">Bordure :</label>
        <?php echo get_border_dropdown(); ?>
        <input type="hidden" name="current_url" value="<?= $current_url ?>">
        <button type="submit">Ok</button>
    </form>

    <!-- Menu de navigation -->
    <nav id="menu">
        <?php

        // Filtrer le menu en fonction de la connexion
        // Si l'utilisateur n'est pas connecté, on affiche uniquement "Login"
        if (!isset($_SESSION['user'])) {
            // Si déconnecté, ne montrer que "Accueil" et "Login"
            $menu_a = array_filter($menu_a, function($item) {
                $text = trim($item[0]);
                return in_array($text, ["Accueil", "Login"]);
            });
        }
        // Parcours du tableau de menu pour générer les liens de navigation
        foreach ($menu_a as $menu) {
            if (count($menu) < 2) continue;
            $text = $menu[0];
            $link = $menu[1];
            $option = isset($menu[2]) ? "&name={$menu[2]}" : "";
            echo "<a href='?page=$link$option'>$text</a> | ";
        }
        ?>
    </nav>


</header>
<main>
    <?php
    if ($debug) {
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
        <h4>NEWS</h4>
        <ul>
            <li><a href="#">World</a></li>
            <li><a href="#">Politics</a></li>
            <li><a href="#">The Great Read</a></li>
        </ul>
    </div>
    <div class="footer-section">
        <h3>ARTS</h3>
        <ul>
            <li><a href="#">Dance</a></li>
            <li><a href="#">Books</a></li>
            <li><a href="#">Headway</a></li>
        </ul>
    </div>
    <hr>
    <div class="footer-copyright">
        &copy; 2024 The New York Times Company NYTCoContact UsAccessibilityWork with usAdvertiseT Brand StudioYour Ad ChoicesPrivacy PolicyTerms of ServiceTerms of SaleSite MapHelpSubscriptionsManage Privacy Preferences

    </div>
</footer>
</body>
</html>
<?php
return ob_get_clean();
}

?>
