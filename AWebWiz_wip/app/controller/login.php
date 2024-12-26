<?php

//controller prevue pour le login
function main_login()
{
    // si na existe pas prendre la valeur apres
	$action = $_GET['action'] ?? "";
	$msg = '';

	//	if(isset($_POST['logout'] ))
	if( $action == 'logout' )
	{
		// l'utilisateur est en train de se délogguer
		// logout_print();
		session_unset();
		$msg = 'Vous êtes déloggué. ';
	}

    //sa veut dire qu'il y aun formulaire identifier
	if( ! empty($_POST['identifier']))
	{
        // il y a une fonction login_validate
		// l'utilisateur est en train de s'identifier
        //login_validate qui nous dis si le login entre est correcte
		list( $valide, $_SESSION['id'], $_SESSION['role'] ) = login_validate($_POST['identifier']);
		// si identification ratée
		if( ! $valide )
		{
			// unknown_user_print();
			session_unset();
			$msg = "Vous n'êtes pas identifié.";
		}
	}

	if(isset($_SESSION['id']))
	{
		// l'utilisateur est déjà identifié
        //=> on lui propose le logout
    $msg .= html_logout_button();
    }
	else
	{
		// l'utilisateur n'est pas identifié
		$msg .= html_unidentified_user();
	}

    return join( "\n", [
		ctrl_head(),
		html_open_form(),
		$msg,
		html_link_home(),
		html_close_form(),
		html_foot()
	]);

}

?>