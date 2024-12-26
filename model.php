<?php
//on va definir des fonctions relatif au traitrement des donner
//si on veut ajouter plusieur utilisateur, une base de donner,  les mots de passer c est ici

function check_loggin($loggin): bool
{
    $authorizad_user = "claude";

    return($loggin == $authorizad_user);
    ////return true ou false
}
