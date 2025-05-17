<?php

//je peux pas mettre conste partout
//envirenoment de developement
const MACHINE = "classe38"; // "classe38" ou  "home" ou ... ce qu'on veut

/**,
 * DATABASE_TYPE : "SQL" ou "JSON"
 */
const DATABASE_TYPE = "SQL";
//voici la base de donner en classe 38 et en home
switch (DATABASE_TYPE) {
    case "SQL":
        define(  "DATABASE_NAME", "press_2024_v03");// La base en mode SQL.
        break;
}

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

// La DSN me permet de me connecter à la DB.
const DATABASE_DSN =  "mysql:host=localhost;dbname=".DATABASE_NAME.";port=".DATABASE_PORT.";";



