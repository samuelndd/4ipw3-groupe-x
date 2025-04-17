<?php
require_once '../app/model/login.php';
require_once '../app/view/login.php';

//Fonction principale de la page de login.
//Ici, je gère l'identification et le logout via l'API, et sauvegarde les informations dans la session.

function main_login() {
    $message = '';

    // Si l'utilisateur soumet le formulaire de connexion, je vérifie ses identifiants.
    if (isset($_POST['login'])) {
        $avatar = $_POST['avatar'];
        $passwd = $_POST['passwd'];
        $auth = validate_api($avatar, $passwd);
        if (!isset($auth['identified']) || !$auth['identified']) {
            $message = "<div>" .($avatar) . " inconnu !</div>";
        } else {
            // C'est pour sauvegarde dans la session user et le role
            $_SESSION['user'] = $auth['name'];
            $_SESSION['role'] = $auth['role'];
            $message = "<div> Bonjour ".$_SESSION['user']."</div>";
        }
    }

    // Si l'utilisateur souhaite se déconnecter
    if (isset($_POST['logout'])) {
        unset($_SESSION['user']);
        unset($_SESSION['role']);
        $message = "<div>Vous êtes déconnecter.</div>";
    }

    return join("\n", [
        ctrl_head(),
        html_login_form($message),
        html_foot()
    ]);
}
