<?php

/**
 * retourne l'article à afficher sur la home page
 * en première position
 * temporairement c'est l'article d'id 1
 * @param $art_id id de l'article à getter dans la db
 * @return assoc array avec les données de l'article
 */
//losque tu clique sur un aricles il affiche le contenue
function get_article_a($art_id)
{
    //Code du prof pour vérifie le type de base de données utilisé
    switch (DATABASE_TYPE) {
        case "SQL":
            return get_article_a_sql($art_id);
    }
}

//losque tu clique sur un aricles il affiche le contenue
function get_article_a_sql($art_id)
{
    $q = <<< SQL
        SELECT
            ident_art AS id,
            title_art AS title,
            '' AS hook,
            content_art AS content,
            `fk_category_art` AS category,
            date_art AS date_published, 
            image_art AS image_name
        FROM t_article
        WHERE 
            ident_art = :ident_art ;
SQL;
    //récupération l'objet PDO pour exécuter la requête SQL.
    $pdo = get_pdo();
    //Préparation de la requête pour pouvoir l'exécuter avec un paramètre sécurisé.
    $stmt = $pdo->prepare($q);
    $param = ['ident_art' => $art_id];
    //Exécution de la requête avec un paramètre spécifié.
    $stmt->execute($param);
    //Récupération du résultat sous forme d'un tableau associatif.
    $result = $stmt->fetch();
    //Retour du résultat
    return $result;
}




// Fonction pour récupérer tous les articles à afficher sur l'accueil.
//en filtrant par catégorie ""on n'est pas des pigeons"" (10 max)"
//et je utiliser la clé etrentrger fk_category_art = 146 pour afficher
//sachant que 146 est le numero correspondant a cette catégorie
function get_all_article_ac_sql($limit=DEFAULT_ACCUEIL_LIMIT): array
{
    $q = <<<SQL
        SELECT
            ident_art AS id,
            title_art AS title,
            '' AS hook,
            content_art AS content,
            fk_category_art AS category,
            date_art AS date_published, 
            image_art AS image_name
        FROM t_article
        WHERE fk_category_art = 146
        ORDER BY ident_art DESC 
        LIMIT :limit
SQL;

    $pdo = get_pdo();
    $stmt = $pdo->prepare($q);
    //Lecture de la valeur du paramètre "limit" en précisant qu'il s'agit d'un entier.
    $stmt->bindParam( ':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}












/**
 * retourne tous (?) les articles de la db
 * @return mixed
 */

// Là, je me base sur votre code (prof) .

function get_all_article_a($kw='', $limit=DEFAULT_SEARCH_LIMIT, $date_min = '', $date_max = '')
{
    switch(DATABASE_TYPE) {
        case "SQL":
            return get_all_article_a_sql($kw, $limit, $date_min, $date_max);
            }
}

function get_all_article_a_sql($kw='', $limit=DEFAULT_SEARCH_LIMIT, $date_min = '', $date_max = ''): array
{
    $q = "SELECT
        ident_art AS id,
        title_art AS title,
        hook_art AS hook,
        content_art AS content,
        fk_category_art AS category,
        date_art AS date_published
            FROM t_article
            WHERE 1=1";
    //me permet de prépare un tableau pour stocker les paramètres de la requête.
    $params = [];
    // Lorsque l'utilisateur saisit un mot-clé, les articles filtre par titre.
    if ($kw !== '') {
        $q .= " AND title_art LIKE :kw_string";
        $params[':kw_string'] = "%$kw%"; //% aide a la recherche partielle.
    }
    //losqu'on mettra une date mini,les articles seront filtre avec cette date.
    if ($date_min !== '') {
        $q .= " AND date_art >= :date_min";
        $params[':date_min'] = $date_min;
    }
    //losqu'on mettra une date max, les articles seront filtre avec cette date.
    if ($date_max !== '') {
        $q .= " AND date_art <= :date_max";// Condition pour la date max
        $params[':date_max'] = $date_max;
    }
   //m'aider a affiche le nombre de résulta'
    //$q elle contient une requête SQL
    $q .= " ORDER BY ident_art DESC LIMIT " . (int)$limit;
    // Récupération de l'objet PDO pour la connexion à la base de données
    $pdo = get_pdo();
    $stmt = $pdo->prepare($q);
    //bindValue() c'est une méthode utilisée pour lier chaque paramètre stocké dans le tableau $params.
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
// exécution la requête préparée avec tous les paramètres
    $stmt->execute();
    // Récupération de tous les résultats sous forme de tableau associatif et retourne le résultat
    return $stmt->fetchAll();
}