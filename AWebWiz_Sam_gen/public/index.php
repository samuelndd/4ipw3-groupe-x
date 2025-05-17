<?php
//c'est le router il dermare la session il inclue tout lrs fichier php
require_once "../app/config/app.php";
require_once "../app/config/model.php";

/**
 * include all MVC PHP files
 */
function include_mvc_php_files()
{
    //manipuler  les systemes des fichier
    //il les scen
    //root_dir definie dans appp conf
    // include all PHP files
    foreach ( array( 'model', 'view', 'controller') as $dir )
    {
        $file_a = scandir(ROOT_DIR.$dir);

        foreach ( $file_a as $file)
        {
            if( substr( $file, -4, 4 ) != ".php" ) continue;
            // echo($file."\n");
            require_once( ROOT_DIR.$dir.DIRECTORY_SEPARATOR.$file );
        }
    }

}

///////////////////////////////////////////////////////////////////////////////
//// Je définis ici la durée de vie du cookie de session à 2 secondes.
session_set_cookie_params(780000);
// ROUTER
session_start();//demart la sesseion.

include_mvc_php_files();//inclure tout les fichier php

// select page to load, ie. function to call
// $page = @$_GET['page'] ?: 'home';
// making router more universal => using superglobal REQUEST instead of POST or GET
// $_REQUEST c'est get ou post c'est l'ensemble des 2
//si requeste de page n'existe pas alors pas d'envoie de message a l'ecrant
$page = $_REQUEST['page'] ?? 'home';
$main = "main_{$page}";
echo $main();
