<?php

function main_panier()
{
    if (!isset($_SESSION['panier']))
    {
        $_SESSION['panier'] = [];
    }

    return join( "\n", [
        ctrl_head(),
        html_panier_main(),
        html_foot(),
    ]);
}

?>