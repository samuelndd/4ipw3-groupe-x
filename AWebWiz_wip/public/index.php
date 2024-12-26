<?php
require_once "../app/config/app.php";
require_once "../app/config/model.php";

/**
 * include all MVC PHP files
 */
function include_mvc_php_files()
{
	// include all PHP files
    //va lire les trois
	foreach ( array( 'model', 'view', 'controller') as $dir )
	{
        //fonction php qui m'annipuler le system de fichier dans le root dir
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

// ROUTER
//Le router démarer le session
session_start();

//cettte lance une petit fonction qui inclue tout les fichier Php
include_mvc_php_files();

// select page to load, ie. function to call
// $page = @$_GET['page'] ?: 'home';
// making router more universal => using superglobal REQUEST instead of POST or GET
//$_REQUEST c'est get ou post l'union de get et post
//@ si a un proble me n'est pas envoyer de message a lecrant
$page = $_REQUEST['page'] ?? 'home';
$main = "main_{$page}";
echo $main();

