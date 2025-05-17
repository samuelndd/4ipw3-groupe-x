<?php
require_once '../app/model/login.php'; // Charge le modèle login pour valider les identifiants via l'API
require_once '../app/view/login.php'; // Charge la vue login pour afficher le formulaire

// Fonction principale de la page de login.
// Ici, je gère l'identification et le logout via l'API, et sauvegarde les informations dans la session.
function main_login() { // Déclaration de la fonction main_login

    // Initialise la variable de message (vide par défaut)
    $message = ''; // Message d'information ou d'erreur

    // Si l'utilisateur soumet le formulaire de connexion, je vérifie ses identifiants.
    if (isset($_POST['login'])) { // Vérifie si le formulaire de login a été soumis
        // Récupère le login et le mot de passe envoyés
        $avatar = $_POST['avatar']; // Identifiant utilisateur depuis le POST
        $passwd = $_POST['passwd']; // Mot de passe depuis le POST
        // Appelle le modèle pour valider les identifiants auprès de l’API
        $auth = validate_api($avatar, $passwd); // Appel à l'API d'authentification
        // Si l’API ne renvoie pas identified = true
        if (!isset($auth['identified']) || !$auth['identified']) { // Vérifie l'état d'authentification
            // Prépare un message d’erreur
            $message = "<div>" . ($avatar) . " inconnu !</div>"; // Message d'erreur pour avatar inconnu
        } else { // Sinon, authentification réussie
            // C'est pour sauvegarde dans la session user et le role
            // Stocke le nom d’utilisateur et son rôle en session
            $_SESSION['user'] = $auth['name']; // Sauvegarde du nom d'utilisateur
            $_SESSION['role'] = $auth['role']; // Sauvegarde du rôle utilisateur
            // Prépare un message de bienvenue
            $message = "<div> Bonjour " . $_SESSION['user'] . "</div>"; // Message de bienvenue
        }
    }

    // Si l'utilisateur souhaite se déconnecter
    if (isset($_POST['logout'])) { // Vérifie si le formulaire de logout a été soumis
        // Supprime les informations de l’utilisateur de la session
        unset($_SESSION['user']); // Suppression de l'utilisateur en session
        unset($_SESSION['role']); // Suppression du rôle en session
        // Prépare un message de confirmation de déconnexion
        $message = "<div>Vous êtes déconnecter.</div>"; // Message de déconnexion
    }

    return join("\n", [
        ctrl_head(),
        html_login_form($message), // Génère le formulaire de login avec le message
        html_foot()
    ]);
}

?>
