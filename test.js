function showAlert() {
    alert("Alert!");
}

let isPlaying = false;
const audio = document.getElementById("music");
const musicButton = document.getElementById("musicButton");

function musicBox(){

	if(!isPlaying){
		audio.play();
		musicButton.src = "../extra/soundOn.png";
	}else{
		audio.pause();
		musicButton.src = "../extra/soundOff.png";
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

function slideshow() {
    slide.style.opacity = 0;

    setTimeout(() => {
        slide.style.backgroundImage = "url(" + photos[i] + ")";
        slide.style.opacity = 1;
        if (i < (photos.length - 1)) {
            i++;
        } else {
            i = 0;
        }
    }, 700); // wait 1s for fade-out
}

window.onload = function () {
    slide = document.querySelector(".slideshow");
    setInterval(slideshow, 5000); // run every 4 seconds
};

function checkForm() {
    var results = document.getElementsByTagName('form');
    var form = results[0];
    var children = form.children;

    var isOk = true;
    var msg = '';

    for (i = 0; i < children.length; i++) {
        var child = children[i];
        if (child.value === " ") {
            isOk = false;
            msg = 'champ' + child.name + 'est vide !';
        }
    }

    if (isOk) {
        alert('Formulaire valide ! en cours de traitement...');
        form.submit();
    } else {
        var p = document.getElementById(123);
        if (p == null) {
            p = new document.createElement("p");
            p.classList.add('error');
            p.id = 123;
            form.appendChild(p);
        }
        p.innerText = msg;
    }

}

let eyeOpen = false;

function showPassword() {

    var mdp_champ = document.getElementsByName('mdp')[0];
    var img_eye = document.getElementById('eye');


    if (!eyeOpen) {
        mdp_champ.type = "text";
        img_eye.src = "../img/eye_open.png";
        eyeOpen = true;
    } else {
        mdp_champ.type = "password";
        img_eye.src = "../img/eye_closed.png";
        eyeOpen = false;
    }

}

function verifSearch() { //pour verifier les recherches de voyages
    var form = document.getElementById('search');

}

function Compteur() {
    var mdp = document.getElementsByName('mdp')[0];
    var compteur = document.getElementById('compteur');
    var min_message = document.getElementById('minimum');

    mdp.value = mdp.value.trim();
    var longueur = mdp.value.length;
    compteur.innerText = longueur + " / 10";

    if (longueur < 5) {
        min_message.innerText = "mininum 5 caractères.";
    } else {
        min_message.innerText = "";
    }
}

function verifForm() {
    var form = document.getElementById('form');

    var nom = document.getElementsByName('nom')[0];
    var prenom = document.getElementsByName('prenom')[0];
    var email = document.getElementsByName('email')[0];
    var mdp = document.getElementsByName('mdp')[0];

    var errors = document.getElementById('errors');

    var correct = true;
    var errorMessages = [];

    if (nom.value.trim() === "") {
        errorMessages.push("Champ Nom est vide !");
        nom.parentElement.style.borderColor = "#e35532";
        nom.focus();
        correct = false;
    } else {
        nom.parentElement.style.borderColor = "#80de64";
    }


    if (prenom.value.trim() === "") {
        errorMessages.push("Champ Prénom est vide !");
        prenom.parentElement.style.borderColor = "#e35532";
        prenom.focus();
        correct = false;
    } else {
        prenom.parentElement.style.borderColor = "#80de64";
    }

    const email_valide = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.value.trim() === "") {
        errorMessages.push("Champ Email est vide !");
        email.parentElement.style.borderColor = "#e35532";
        email.focus();
        correct = false;
    }
    else if (!email_valide.test(email.value.trim())) {
        errorMessages.push("L'Email est incorrect !");
        email.parentElement.style.borderColor = "#e35532";
        correct = false;
    } else {
        email.parentElement.style.borderColor = "#80de64";
    }

    if (mdp.value.trim() === "") {
        errorMessages.push("Champ Mot de passe est vide !");
        mdp.parentElement.style.borderColor = "#e35532";
        mdp.focus();
        correct = false;
    }
    if (mdp.value.length < 5) {
        errorMessages.push("Nombre de caractères < à 5");
        mdp.parentElement.style.borderColor = "#e35532";
        correct = false;
    } else {
        mdp.parentElement.style.borderColor = "#80de64";
    }

    if (correct) {
        errors.innerHTML = "";
        form.submit();
        return true;
    } else {
        errors.innerHTML = "\n" + errorMessages.join("<strong><h2></h2></strong>") + "\n";
        return false;
    }
}


function modifier(champ) {
    var input = document.querySelector(`input[name="${champ}"]`);
    var boutons = input.parentElement.querySelector('.boutons_user');

    input.dataset.val_initial = input.value; // stocke l'ancienne valeur
    input.disabled = false;
    boutons.style.display = 'flex';

    document.getElementById("user_submit").style.display = 'none';
}

function annuler(champ) {
    var input = document.querySelector(`input[name="${champ}"]`);
    var boutons = input.parentElement.querySelector('.boutons_user');

    input.value = input.dataset.val_initial;
    input.disabled = true;
    boutons.style.display = 'none';
}

function valider(champ) {
    var input = document.querySelector(`input[name="${champ}"]`);
    var boutons = input.parentElement.querySelector('.boutons_user');

    input.readOnly = true;
    boutons.style.display = 'none';

    // Affiche le bouton Soumettre
    document.getElementById("user_submit").style.display = 'inline-block';
}

function statutModif(userEmail) {
    var valider = document.getElementsByName('statut_submit_' + userEmail)[0];
    var statut = document.getElementsByName('statut_' + userEmail)[0];

    valider.disabled = true;
    statut.disabled = true;

    setTimeout(function () {
        valider.disabled = false;
        statut.disabled = false;
        alert(`Le statut de l'utilisateur avec l'email ${userEmail} a été mis à jour à : ${statut.value}`);
    }, 1000);

    valider.disabled = true;
    statut.disabled = true;

}

function trier() {
    var prix = document.getElementById("prix").value;
    var duree = document.getElementById("duree").value;
    var etapes = document.getElementById("etapes").value;

    var apercus = document.querySelectorAll(".thumbnail");
    var voyages = [];
    for (i = 0; i < apercus.length; i++) {
        voyages.push(apercus[i].parentElement);
    }

    voyages.sort(function (a, b) {
        var aPrix = parseFloat(a.querySelector(".thumbnail").getAttribute("data-prix"));
        var bPrix = parseFloat(b.querySelector(".thumbnail").getAttribute("data-prix"));

        var aDuree = parseInt(a.querySelector(".thumbnail").getAttribute("data-duree"));
        var bDuree = parseInt(b.querySelector(".thumbnail").getAttribute("data-duree"));

        var aEtapes = parseInt(a.querySelector(".thumbnail").getAttribute("data-etapes"));
        var bEtapes = parseInt(b.querySelector(".thumbnail").getAttribute("data-etapes"));

        if (prix === "prixCroi") {
            return aPrix - bPrix;
        } else if (prix === "prixDecroi") {
            return bPrix - aPrix;
        } else if (duree === "dureeCroi") {
            return aDuree - bDuree;
        } else if (duree === "dureeDecroi") {
            return bDuree - aDuree;
        } else if (etapes === "etapesCroi") {
            return aEtapes - bEtapes;
        } else if (etapes === "etapesDecroi") {
            return bEtapes - aEtapes;
        }

        return 0;
    });


    var content = document.querySelector('.voyages');
    voyages.forEach(function (voyage) {
        content.appendChild(voyage);
    });
}

let modedark = false;
function color(){
	var img_mode = document.getElementById('mode');
	if (!modedark){
		img_mode.src='../img/main_mode.png';
		document.getElementsByClassName('aaa')[0].href='../css/dark.css';
		modedark = true;
	}
	else{
		img_mode.src='../img/dark_mode.png';
		document.getElementsByClassName('aaa')[0].href='../css/main.css';
		modedark = false;
	}
}
