<?php
session_start();
require_once("view.php");
require_once("math.php");
require_once("model.php");

//le true fait que le json est considerer comme un table
$_COOKIE_login_a = json_decode($_COOKIE['login'] ?? '', true);
//on verifier si un cookie est déja envoyer par le navigateur
//le fait que le cookie 'loggin' existe c'est que la perssonner est déja logge
//le fait que le cookie 'loggin' n'existe pas c'est que la perssonner n'est pas logge
// cas générale
$is_login_valid = isset($_COOKIE_login_a['is_logged']);

//pour eviter les warning
if ($is_login_valid)
{
    //comment on recuper le nom de la personner
    //// tableau assosiatif c'est lie a $v ligne 57
    /// // est si n'existe pas donc false
    /// //l'intention c'est de recuoerer le nom de la personer
    $login_name = $_COOKIE['name'] ?? '';
}

    /*
    //est ce que le ga est deja logger
    if(isset($_SESSION['login']['is_logged'])
    and $_SESSION['login']['is_logged'])
    {
       //déja loggué
    }*/
// cas particulier
    if(isset($_POST['set_logout']))
    {
    //il se délogue
    //on va suprimer le cookie qui nous conserner 'login'
    $message = "Vous vous etes déloggué.";
    setcookie('login', 0, 0, "/" );
    $is_login_valid = false;
    //unset($_SESSION['login']);
    //unset($_SESSION['bg_color']);
    }

// cas particulier
    //scenario la personne est entrain de se connecter dans se cas
    // $is_login_valid va rece voir une nouvelle valeur
    if(isset($_POST['set_login']))
    {
        //check_loggin fait apppel au donner de l'app
        //quelq'un a cliqué sur le bouton log
        //on a capture se qui est dans l impute texte dnas $login
        $login_name = $_POST['my_login'];
        $is_login_valid = check_loggin($login_name);
        if ($is_login_valid)
        {
            //user identified
            // $login_name = on donner le nom de la personner
            //il faut que l'identiter rester pendant un certain temps
            //$_SESSION['login']['is_logged']= true;
            //$_SESSION['login']['name']= $login;
            //nouveau cookie a été creer
            $v = json_encode([
                'is_logged' => true,
                'name'  => $login_name,
            ]);
            setcookie('login',$v, time()+60*5, "/" );
        }
        else
        {
            //user not identified
            //on va exprimer par la destruction des login qui peut exister
           // unset($_SESSION['login']);
            //si le login n est pas correct $is_login_valid est false le cookie rester a 0
            setcookie('login', 0, 0, "/" );
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
    //est ce que un cookie est déja définie si oui on le prend si non sa seras lightskyblue
    $bg_color = $_COOKIE['bg_color'] ?? 'lightskyblue';
    if(isset($_POST['set_bgcolor']))
    {
        //l'utlisateur a cliqué sur le bouton
        $bg_color = $_POST['my_favorite_color'];
    }
    //$_COOKIE['bg_color'] = $bg_color;
    //setcookie expirant ds 5 min
    setcookie('bg_color',$bg_color, time()+60*5, "/" )

    ?>




<html>
<head>

    <?php
    echo style_sheet($bg_color);
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
// soit elle est identifier c'est log out soit elle est pas c'est log on
// $is_login_valid c'est la variable qui me dis oui ou non la personner est bien logge
if($is_login_valid)
{
    //bienvenue
    echo <<< HTML
    <form method="post" >
        <p>Bienvenue {$login_name}</p>
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