<?php
// const et define sont equivalents
//const ne peux que etre  utiliser qu'on tete de fichier




//la c'est in constance avec son nom et sa valeur const MACHINE = "classe38";

const MACHINE = "classe38"; // "classe38" ou  "home" ou ... ce qu'on veut

/**
 * DATABASE_TYPE : "SQL" ou "JSON"
 * la c'est in constance avec son nom et sa valeur const DATABASE_TYPE = "SQL";

 */
const DATABASE_TYPE = "SQL";

switch (DATABASE_TYPE) {
    case "SQL":
        define(  "DATABASE_NAME", "press_2024_v03");
        break;
    case "JSON":
        define(  "DATABASE_NAME", "../asset/database/article.json");
        break;
}

//2 conficque avec fonction MACHINE
switch(MACHINE) {
	// ISFCE, classe 38
	case "classe38":
		define( "DATABASE_PORT", 3307 ); 	// MAriaDB
		define( "DATABASE_USERNAME", "root" );
		define( "DATABASE_PASSWORD", "" );
		break;
	case "home":
		define( "DATABASE_PORT", 3306 );  	// MysSQL
		define( "DATABASE_USERNAME", "root" );
		define( "DATABASE_PASSWORD", "" );
		break;
}

const DATABASE_DSN =  "mysql:host=localhost;dbname=".DATABASE_NAME.";port=".DATABASE_PORT.";";

