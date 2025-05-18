let playerWindow = null;

function musicBox() {
    if (!playerWindow || playerWindow.closed) {
        playerWindow = window.open("../extra/musicPlayer.html", "musicPlayer", "width=1,height=1,resizable=no");
        window.blur();
    } else {
        playerWindow.close();
    }
}

var photos = [
    "../img/imgVoyages/0.jpg",
    "../img/imgVoyages/1.png",
    "../img/imgVoyages/2.png",
    "../img/imgVoyages/3.jpg"
];

var i = 0;
var slide;


function color() {

    let actuel;
    let nouveau;

    if (document.cookie.includes("style=dark")) {
        actuel = "dark";

    } else {
        actuel = "main";
    }

    if (actuel === "dark") {
        nouveau = "main";
    } else {
        nouveau = "dark";
    }
    document.cookie = "style=" + nouveau + "; path=/; max-age=" + (360 * 60);
    location.reload();
}


function slideshow() {

    if (slide) {
        slide.style.opacity = 0;

        setTimeout(() => {
            slide.style.backgroundImage = "url(" + photos[i] + ")";
            slide.style.opacity = 1;
            if (i < (photos.length - 1)) {
                i++;
            } else {
                i = 0;
            }
        }, 700); // fade-out ici !
    } else {
        console.log("Erreur : slide n'existe pas !");
    }
}

window.onload = function () {
    slide = document.querySelector(".slideshow");
    setInterval(slideshow, 5000); // run every 4 seconds
};
