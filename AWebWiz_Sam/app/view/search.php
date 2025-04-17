<?php
//code prof
// Cette fonction génère le formulaire de recherche pour filtrer les articles.

function html_search_form($kw='', $lim=DEFAULT_SEARCH_LIMIT,$date_min = '', $date_max = '')
{
    return <<< HTML
        <form method="post">
            <label>Introduisez votre mot-clé</label>
            <input name="search_kw" type="text" value="$kw">
            <label>Nombre de résultats</label>
            <input name="search_limit" type="number" value="$lim">
            <label>Date minimale :</label>
            <input name="search_date_min" type="date" value="$date_min">
            <label>Date maximale :</label>
            <input name="search_date_max" type="date" value="$date_max">
            <button name="b_search">rechercher</button>
        </form>
HTML;
}
