<?php
//code prof
function get_static_content($name)
{
    try
    {
        //Permet récupérer le contenu d'une page statique depuis le dossier asset.
        //file_get_contents succes tout le contneue est le mettre dans un string
        $fn = "../asset/static_content/$name.html";
        $html_s = file_get_contents($fn);
        //retour le sting
        return $html_s;
    }
    catch( Exception $e)
    {
        // Ça permet d'informer l'utilisateur que la page n'a pas été trouvée sans planter le site.
        return "erreur 404 - page non trouvée";
    }
}
