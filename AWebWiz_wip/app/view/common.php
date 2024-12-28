<?php

//on commence d'abort du code
function html_head($menu_a=[], $user_id="", $user_role="")
{
    $debug = false;
	ob_start();
    // et puis du html
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
        <h1>
            France 24 (MVC)
            <img src="./media/icon3.png">
        </h1>
        <?php

        //pour le menu
        foreach ( $menu_a as $menu)
        {
            $text = $menu[0];
            $link = $menu[1];
            $option = isset($menu[2]) ? "&name={$menu[2]}" : "";
            //pour mettre une serie de lien
            echo  <<< HTML
                <a href="?page=$link$option">$text</a> |
HTML;
        }
         ?>
        Welcome, <?=$user_id?> (<?=$user_role?>).
    </header>
    <main>
    <?php

	if($debug)
	{
        echo "<pre>";
        var_dump($_COOKIE);
                var_dump($_SESSION);
        var_dump($_GET);
        var_dump($_POST);
        echo "</pre>";
    }
        //je recupere les contenue du topmpon et return des chaines des caracteres
	    return ob_get_clean();
}

//fin de la page
function html_foot()
{
    ob_start();
    ?>
    </main>
    <footer>
        <hr/>
        Made with the amazing AWebWiz framework
        <img src="./media/awebwiz.png" alt="AWebWiz logo">
    </footer>
    </body>
    </html>
    <?php
    return ob_get_clean();
}