
let isPlaying = false;
const audio = new Audio("../img/music.wav");
const musicButton = document.getElementById("musicButton");
audio.loop = true;

function musicBox() {
    if (!isPlaying) {
        audio.play();
        //musicButton.src = "../img/musicOn.png";
    } else {
        audio.pause();
        //musicButton.src = "../img/musicOff.png";
    }
    isPlaying = !isPlaying;
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

    var img = document.getElementById("mode");

    if (document.cookie.includes("style=dark")) {
        actuel = "dark";

    } else {
        actuel = "main";
    }

    if (actuel === "dark") {
        nouveau = "main";
        img.src = "../img/main_mode.png";
    } else {
        nouveau = "dark";
        img.src = "../img/dark_mode.png";
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
