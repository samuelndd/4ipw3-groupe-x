<?php

require_once '../app/view/sponsor.php'; // elle contient html_banner

function main_sponsor()
{
    //Contenu du sponsor
    $banner = get_sponsor_content();

    return join("\n", [
        ctrl_head(),
        html_banner($banner),
        html_foot()
    ]);
}
