<?php
session_start();
require_once("view.php");
require_once("math.php");
require_once("model.php");
?>
<html>
<head>

    <?php
    /*
    //est ce que le ga est deja logger
    if(isset($_SESSION['login']['is_logged'])
    and $_SESSION['login']['is_logged'])
    {
       //déja loggué
    }*/
    if(isset($_POST['set_logout']))
    {
    //il se délogue
    $message = "Vous vous etes déloggué.";
    unset($_SESSION['login']);
    unset($_SESSION['bg_color']);

    }


    //scenario oun l'utilisateur a cliqué
    if(isset($_POST['set_login']))
    {
        //check_loggin fait apppel au donner de l'app
        //quelq'un a cliqué sur le bouton log
        //on a capture se qui est dans l impute texte dnas $login
        $login = $_POST['my_login'];
        $is_valid = check_loggin($login);
        if ($is_valid)
        {
            //user identified
            //il faut que l'identiter rester pendant un certain temps
            $_SESSION['login']['is_logged']= true;
            $_SESSION['login']['name']= $login;
        }
        else
        {
            //user not identified
            //on va exprimer par la destruction des login qui peut exister
            unset($_SESSION['login']);
            //pour les identifiant non reconnu
            $message = "Identifiant non reconnu. Veuillez réessayer";
        }
    }
    ?>





    <?php
    /*
    //pour savoir si quelque chose existe on utilise in if
    // elle nous definie une couleur par defaut
    //elle enregistre la couleur pendant un certains temps
    if(isset($_SESSION['bg_color']))
    {
        $bg_color = $_SESSION['bg_color'];
    }
    else
    {
        $bg_color = 'lightskyblue';
    }*/ //c est identique au treuc juste en bas
    // bg color chercher d abort la sessions si elle existe et si elle n es pas elle prend une valeur par defaut
    $bg_color = $_SESSION['bg_color'] ?? 'lightskyblue';
    if(isset($_POST['set_bgcolor']))
    {
        //l'utlisateur a cliqué sur le bouton
        $bg_color = $_POST['my_favorite_color'];
    }

    echo style_sheet($bg_color);
    $_SESSION['bg_color'] = $bg_color;
    ?>

</head>
<body>

<?php
//permet d'affiche les entres quand meme dans la barre de recherche '
if(isset($_POST['process_b']))
{
    //donner proviens du formulaire
    //var_dump($_GET); //variable get
    //le bouton process_b a ete cliqué

    echo <<< HTML
    <h1>contenu du form</h1>
    HTML;
    //var_dump($_POST);

    foreach ($_POST as $key => $value)
    {
        if(is_array($value))
        {
            $out = implode("|", $value);
        }
        else
        {
            $out = $value;
        }
        echo <<< HTML
            <P> $key => $out </P>
HTML;

    }
}


?>

<h1>Formulaire</h1>

<?php
//echo my_first_form();
//echo my_second_form();
echo form_background($bg_color);
?>



<h1>Log in</h1>
<?php
if(isset($_SESSION['login']['is_logged'])
and $_SESSION['login']['is_logged'])
{
    //bienvenue
    echo <<< HTML
    <form method="post" >
        <p>Bienvenue {$_SESSION['login']['name']}</p>
    	<button name="set_logout" type="submit"> log out ! </button>
    </form>
HTML;
}
else
{
    //nin loggé
    echo form_login();
    if(isset($message))
    {
        //bienvenue
        echo <<< HTML
            <p>$message</p>
HTML;
    }
}
?>

</body>
</html>