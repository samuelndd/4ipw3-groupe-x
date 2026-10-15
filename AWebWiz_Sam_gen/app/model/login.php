<?php

/**
 * Vérifie mes propres identifiants sans utiliser l'API.
 * Renvoie les mêmes informations pour garder le contrôleur compatible.
 */
function validate_api($login, $passwd)
{
    // Mon identifiant.
    $monLogin = 'samuel';

    // Le hash du mot de passe choisi.
    $monMotDePasseHache = '$2y$10$YN3HufJBhmHMmhmjE6x76O5w2PqnD8vQPggmJZuR36rnhLXQ5bu6.';
    
    // Vérification de l'identifiant et du mot de passe.
    if (
        is_string($login) &&
        is_string($passwd) &&
        $login === $monLogin &&
        password_verify($passwd, $monMotDePasseHache)
    ) {
        return [
            'identified' => true,
            'name' => 'Samuel',
            'role' => 'admin',
        ];
    }

    // Identifiant ou mot de passe incorrect.
    return [
        'identified' => false,
    ];
}