<?php
//stéssiphique au traitement de donner

//sa aurais pu etre serveur
const MACHINE = "classe38"; // "classe38" ou  "home" ou ... ce qu'on veut

/**
 * DATABASE_TYPE : "SQL" ou "JSON"
 */

//on peut pas mettre const  a l'interieur d'un swit case que dans les premier ligne
const DATABASE_TYPE = "MySql";  // "csv"
//la ou doit mettre  le nom de la base de donner

switch (DATABASE_TYPE) {
    case "SQL":
        define(  "DATABASE_NAME", "press_2024_v03");
        break;
    case "JSON":
        define(  "DATABASE_NAME", "../asset/database/article.json");
        break;
}
const DATABASE_NAME = "4ipdw_2023";

switch(MACHINE) {
    //voilois a quoi ressemble la base donner de la classe 38
	// ISFCE, classe 38
	case "classe38":
        //define nous définie les constance "DATABASE_PORT", 3307
		define( "DATABASE_PORT", 3307 ); 	// MAriaDB
		define( "DATABASE_USERNAME", "root" );
		define( "DATABASE_PASSWORD", "" );
		break;
    //voilois a quoi ressemble la base donner lorsque je suis a la maison
    case "home":
		define( "DATABASE_PORT", 3306 );  	// MysSQL
		define( "DATABASE_USERNAME", "root" );
		define( "DATABASE_PASSWORD", "root" );
		break;
}

const DATABASE_DSN =  "mysql:host=localhost;dbname=4ipdw_2023;port=".DATABASE_PORT.";";

// var_dump(DSN);
