// Fonction pour créer des étoiles filantes
function createShootingStar() {
    const star = document.createElement('div');
    star.className = 'shooting-star';
    // Position horizontale aléatoire
    star.style.left = Math.random() * 100 + 'vw';
    // Taille aléatoire entre 3px et 10px
    const size = Math.random() * 7 + 3;
    star.style.width  = size + 'px';
    star.style.height = size + 'px';
    // Durée d’animation aléatoire entre 1s et 3s
    star.style.animationDuration = (Math.random() * 2 + 1) + 's';
    document.body.appendChild(star);
    // Suppression de l’élément à la fin de l’anim
    star.addEventListener('animationend', () => star.remove());
}

// Lancer une étoile toutes les 0.5 à 1.5 s
setInterval(createShootingStar, Math.random() * 1000 + 500);
