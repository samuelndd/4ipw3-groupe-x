$(function() { // Exécute lorsque le DOM est prêt
    $(document).on('submit', '.search-form', function(e) { // Intercepte la soumission du formulaire de recherche
        e.preventDefault(); // Annule l'envoi traditionnel du formulaire
        const form = $(this); // Récupère l'objet jQuery du formulaire soumis
        const formData = form.serialize(); // Sérialise les données du formulaire pour l'envoi AJAX

        $.post('index.php?page=search&ajax=1', formData, function(html) { // Envoie les données en POST via AJAX
            $('.search-results-container').html(html).fadeIn(); // Remplace le contenu des résultats et l'affiche en fondu
        }); // Fin de la requête AJAX POST
    }); // Fin de l'écouteur d'événement submit
}); // Fin de la fonction jQuery ready
