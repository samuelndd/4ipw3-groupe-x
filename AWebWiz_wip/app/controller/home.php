<?php

function main_home():string
{
    //l'idée c'est la fonction va lire le fichier a droite et va recupere specifiquement cette article la
    $article_a = get_article_homepage();
    //partie html
    // join est une fonction qui traiter les chaines de caracteres
    // join est un séparateur et un tableau de chaines de caracter et qui
    // creer que une seul chaine qui concataine tout les chaines du tableau
    //l'ordre est important
	return join( "\n", [
        // tout ce qui commence par html c'est des fonctions de view
        //html_head retournes des chaine des caractere
        //get_menu_array from csv
		                ctrl_head(),
        //c est le coeur
		html_body($article_a),
		html_foot(),
	]);
// le pouit c'est la concatenation
    //des fonctions qui retourne des chaine de caracrtere
    //return html_head() .html_body() .html_foot();

}

