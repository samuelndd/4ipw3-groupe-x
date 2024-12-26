<?php

function get_static_content($name)
{

    try
    {
        $fn = "../asset/static_content/$name.html";
        //recuper tout contenon on chaine de caractere
        $html_s= file_get_contents($fn);
        return  $html_s;
    }
    catch( Exception $e)
	{
        return  "erreur 404 - page non trou";
    }
}
