const content = document.getElementById("content");

const sections = {
    biography: {
        text: `
      <h2>Biography</h2>
      <p><strong>Samuel L. Jackson</strong> was born in 1948 in Washington D.C. and raised by his mother and grandparents in Tennessee. 
      He faced poverty and grew up in a segregated society.</p>

      <h2>Career</h2>
      <p>He started in theater, then slowly built his career in film. His big breakthrough was in 1994 with <em>Pulp Fiction</em>, 
      which earned him an Oscar nomination. He then played in many famous movies like <strong>Marvel</strong>, <strong>Star Wars</strong>, 
      <em>Django Unchained</em>, <em>Coach Carter</em>, and <em>Unbreakable</em>.</p>

      <h2>Challenges</h2>
      <p>Samuel struggled with drug addiction and even overdosed. But he entered rehab and rebuilt his life and career through discipline and resilience.</p>

      <h2>Family</h2>
      <p>He has been married to LaTanya Richardson since 1980 and they have one daughter, Zoe. His family gave him support and stability.</p>

      <h2>Conclusion</h2>
      <p>Samuel L. Jackson is inspiring because he never gave up. He overcame addiction, racism, and poverty to become one of the most powerful actors in the world. 
      His strength, honesty, and confidence inspire millions.</p>
    `,
        img: "images/samuel.webp",
        color: "#222244"
    },

    pulp: {
        text: `
      <h2>Pulp Fiction</h2>
      <p>He plays <strong>Jules Winnfield</strong>, a philosophical hitman who seeks redemption after a moment of reflection. 
      This role is inspiring because it shows how people can change, just like Jackson turned his life around.</p>
    `,
        img: "images/pulp.jpg",
        color: "#3A1F2B"
    },

    marvel: {
        text: `
      <h2>Marvel (Nick Fury)</h2>
      <p>He plays <strong>Nick Fury</strong>, the strategic and fearless leader of S.H.I.E.L.D. 
      His calm, confident attitude mirrors Jackson’s real-life leadership and presence. 
      He proves that power can come from wisdom, not violence.</p>
    `,
        img: "images/marvel.jpg",
        color: "#1F243D"
    },

    django: {
        text: `
      <h2>Django Unchained</h2>
      <p>He plays <strong>Stephen</strong>, a slave who manipulates his master to keep power. 
      It’s a bold and difficult role that shows Jackson’s courage as an actor. 
      He’s not afraid to challenge the audience and spark deep conversation about history.</p>
    `,
        img: "images/django.jpg",
        color: "#3D281F"
    },

    coach: {
        text: `
      <h2>Coach Carter</h2>
      <p>He plays <strong>Ken Carter</strong>, a real basketball coach who shuts down games to make students study. 
      Jackson’s own discipline and belief in education are reflected in this role. 
      He inspires youth to aim higher.</p>
    `,
        img: "images/coach.jpg",
        color: "#2F3C4F"
    },

    incassable: {
        text: `
      <h2>Incassable</h2>
      <p>He plays <strong>Elijah Price</strong> (Mr. Glass), a man with fragile bones who believes in real superheroes. 
      His intelligence and vision turn weakness into strength. 
      This shows Jackson’s ability to make us believe in the impossible — just like he believed in himself.</p>
    `,
        img: "images/incassable.jpg",
        color: "#1F2F2F"
    }
};

function showSection(key) {
    const sec = sections[key];
    content.innerHTML = `
    ${sec.text}
    <img src="${sec.img}" alt="${key}" />
  `;
    document.body.style.backgroundColor = sec.color;
}

showSection("biography");

// Stars background
const canvas = document.getElementById("stars");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const stars = Array.from({ length: 100 }, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    r: Math.random() * 1.5 + 0.5,
    dx: Math.random() * 0.5
}));

function animateStars() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = "white";
    stars.forEach(star => {
        ctx.beginPath();
        ctx.arc(star.x, star.y, star.r, 0, Math.PI * 2);
        ctx.fill();
        star.x += star.dx;
        if (star.x > canvas.width) star.x = 0;
    });
    requestAnimationFrame(animateStars);
}
animateStars();
