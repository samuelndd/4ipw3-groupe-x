$(function(){
    var $content = $('#content');
    var $menu    = $('#menu');

    // Navigation SPA (menu ajax)
    if (AJAX_ENABLED && $menu.length && $content.length) {
        $menu.on('click','a',function(e){
            e.preventDefault();
            var href = $(this).attr('href'),
                sep  = href.includes('?') ? '&' : '?',
                url  = href + sep + 'ajax=1';
            history.pushState({href},'',href);
            $content.fadeOut(150,function(){
                $.get(url,function(html){
                    $content.html(html).fadeIn(150);
                });
            });
        });

        window.onpopstate = function(ev){
            var href = (ev.state && ev.state.href) || location.pathname+location.search,
                sep  = href.includes('?') ? '&' : '?',
                url  = href + sep + 'ajax=1';
            $.get(url, html => $content.html(html));
        };
    }

    // Met à jour le compteur Favoris dans le menu
    function updateFavCount(n) {
        $('#fav-link').text('Favoris ('+n+')');
    }

    // Favoris : ajouter
    $content.on('click', '.add-favorite', function(e){
        e.preventDefault();
        var btn = $(this), id = btn.data('id');
        $.post('index.php?page=panier', {action:'add', art_id:id})
            .done(function(resp){
                updateFavCount(resp.count);
                btn.replaceWith(
                    '<button class="favorite-btn remove remove-favorite" data-id="'+id+'">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">' +
                    '<path d="M8 1C4 3 1 6 1 10s3 5 7 5 7-2 7-5-3-7-7-9z"/>' +
                    '<path d="M8 13c-3 0-5-1-5-3s2-4 5-6c3 2 5 4 5 6s-2 3-5 3z"/>' +
                    '</svg> Retirer 💔' +
                    '</button>'
                );
            });
    });

    // Favoris : retirer
    $content.on('click', '.remove-favorite', function(e){
        e.preventDefault();
        var btn = $(this), id = btn.data('id');
        $.post('index.php?page=panier', {action:'remove', art_id:id})
            .done(function(resp){
                updateFavCount(resp.count);
                var $favSec = btn.closest('section.favorites');
                if ($favSec.length) {
                    var $row = btn.closest('tr');  // ici on détecte <tr> pour le panier
                    if ($row.length) {
                        $row.fadeOut(200, function(){
                            $(this).remove();
                            var newN = $favSec.find('tbody tr').length;
                            $favSec.find('h2').text('Vos Favoris ('+newN+')');
                            if (newN === 0) {
                                $favSec.html('<p>Votre liste de favoris est vide.</p>');
                            }
                        });
                    } else {
                        var $art = btn.closest('article');  // fallback pour les autres pages
                        $art.fadeOut(200, function(){
                            $(this).remove();
                        });
                    }
                } else {
                    // si pas dans section.favorites : fallback (détail article)
                    btn.replaceWith(
                        '<button class="favorite-btn add add-favorite" data-id="'+id+'">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">' +
                        '<path d="M8 2.748l-.717-.737C5.6-.283 2.317 1.76 2.317 4.437c0 3.293 3.5 6.385 8 9.293 4.5-2.908 8-6 8-9.293 0-2.677-3.283-4.72-5.683-3.145L8 2.748z"/>' +
                        '</svg> Ajouter ❤️' +
                        '</button>'
                    );
                }
            });
    });


    // Vider tous les favoris
    $content.on('click', '#clear-favorites', function(e){
        e.preventDefault();
        $.post('index.php?page=panier', {action:'clear'})
            .done(function(resp){
                updateFavCount(resp.count);
                $content.find('section.favorites').fadeOut(300, function(){
                    $(this).html('<p>Votre liste de favoris est vide.</p>').fadeIn(300);
                });
            });
    });

    // Styles dynamiques (police, bordure, thème, taille) => localStorage + serveur
    const themes = {
        yellow:{bg:'lightyellow',fg:'black'},
        rose:  {bg:'lightpink',  fg:'darkred'},
        blue:  {bg:'lightskyblue',fg:'blue'}
    };

    function applyStyles(){
        $('body')
            .css('font-family', $('#font').val() || '')
            .css('border', $('#border').val()==='thin' ? '1px solid black' :
                $('#border').val()==='thick' ? '3px solid black' : '')
            .css('font-size', $('#font_size').val() ? $('#font_size').val()+'px' : '')
            .css('background-color', themes[$('#theme').val()]?.bg || '')
            .css('color', themes[$('#theme').val()]?.fg || '');
    }

    $('#style-form').on('change', '#font,#border', function(){
        $.post('?page=font', {
            font: $('#font').val(),
            border: $('#border').val(),
            current_url: location.pathname+location.search
        });
        applyStyles();
    });

    $('#style-form').on('change', '#font_size,#theme', function(){
        localStorage.setItem(this.id, $(this).val());
        applyStyles();
    });

    ['font_size','theme'].forEach(id => {
        $('#'+id).val(localStorage.getItem(id) || '');
    });

    applyStyles();
});





$(document).ready(function() {
    $('.search-form-container').hide().fadeIn(800);
});

