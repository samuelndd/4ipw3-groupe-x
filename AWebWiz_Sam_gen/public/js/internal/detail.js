$(function() { // Exécute lorsque le DOM est prêt
    // Fonction pour charger les détails d’un article via AJAX
    function loadArticleDetail($article) { // Déclare la fonction loadArticleDetail
        let href = $article.find('a').attr('href'); // Récupère l'attribut href du lien dans l'article
        let art_id_match = href.match(/art_id=(\d+)/); // Extrait l'ID de l'article via expression régulière
        if (!art_id_match) return; // Si aucun ID trouvé, abandonne

        let art_id = art_id_match[1]; // Récupère l'ID de l'article

        if ($article.data('details-loaded')) return; // Si les détails sont déjà chargés, ne fait rien

        $.get('index.php?page=article_detail&ajax=1&art_id=' + art_id, function(html) { // Requête AJAX pour récupérer le détail
            $article.append('<div class="article-detail-overlay">' + html + '</div>'); // Ajoute le contenu reçu dans un overlay
            $article.data('details-loaded', true); // Marque comme chargé pour éviter les requêtes multiples
        });
    }

    function unloadArticleDetail($article) { // Déclare la fonction pour retirer les détails
        $article.find('.article-detail-overlay').remove(); // Supprime l'overlay des détails
        $article.data('details-loaded', false); // Réinitialise l'indicateur de chargement
    }

    // Au survol d'un article (carte, autre section ou en vedette)
    $(document).on('mouseenter', '.press-card, .other article, .featured article', function() { // Événement mouseenter
        loadArticleDetail($(this)); // Charge les détails de l'article survolé
    });

    $(document).on('mouseleave', '.press-card, .other article, .featured article', function() { // Événement mouseleave
        unloadArticleDetail($(this)); // Retire les détails de l'article quand la souris quitte
    });
});
