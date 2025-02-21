<?php

// MODEL

// Récupère la couleur de fond depuis la session ou retourne une couleur par défaut
function getBgColor()
{
    return $_SESSION['bg_color'] ?? 'lightskyblue'; // Retourne la couleur stockée ou une valeur par défaut
}

// Stocke la couleur de fond dans la session
function setBgColor($color)
{
    $_SESSION['bg_color'] = $color; // Stocke la couleur sélectionnée
    $_SESSION['bg_color_time'] = time(); // Stocke l'heure de la mise à jour
}


// Vérifie si la session est expirée
function isSessionExpired($expirationTime = 180) // 180 secondes = 3 minutes
{
    if (!isset($_SESSION['bg_color_time'])) { // Vérifie si l'heure de mise à jour est définie
        return false; // Si non, considère que la session n'est pas expirée
    }
    return (time() - $_SESSION['bg_color_time']) > $expirationTime; // Retourne vrai si la durée d'expiration est dépassée
}