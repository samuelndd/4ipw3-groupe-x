<?php
/**
 * Récupère les données du sponsor depuis le JSON distant.
 *
 * @return array|null Tableau associatif contenant les données du sponsor ou null en cas d'erreur.
 */
function get_sponsor_content() {
    // URL de JSON qui contient les infos de la bannière
    // Cette URL elle me fournit toutes les infos pour de la bannière.
    $json_file_gurl = "http://playground.burotix.be/adv/banner_for_isfce.json";
    // Récupère le contenu en format texte JSON de l’URL
    //file_get_contents lier le json depuis l'url
    $json_string = file_get_contents($json_file_gurl);
    // Décode le JSON en tableau associatif et je extrait 'banner_4IPDW'
    // Résultat : $banner contient un tableau PHP avec les champs : text, image, color.
    //Je décode le JSON pour obtenir un tableau associatif.
    $banner = json_decode($json_string, true);
    return $banner['banner_4IPDW'] ?? null;// null pour éviter des erreurs
}
