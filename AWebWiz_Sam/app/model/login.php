<?php
//je me suis baser sur l'exo24_login_api_php
/**
 * Interroge l'API pour valider l'utilisateur.
 * URI de l'API : http://playground.burotix.be/login/?login=<login>&passwd=<passwd>
 */
function validate_api($login, $passwd) {
    // Je définis ici l'URI de base de l'API.
    $uri_head = "http://playground.burotix.be/login/?";
    // Je crée un tableau associatif pour les paramètres de l'API avec le login et le mot de passe.
    $uri_param = [
        "login"  => $login,
        "passwd" => $passwd,
    ];
    //Construition de l'URI complète en utilisant http_build_query pour encoder correctement les paramètres.
    $uri = $uri_head . http_build_query($uri_param);
    $json_string = file_get_contents($uri);
    // Je décode la chaîne JSON en un tableau associatif pour pouvoir manipuler les données en PHP.
    $auth_a = json_decode($json_string, true);
    return $auth_a;
}
