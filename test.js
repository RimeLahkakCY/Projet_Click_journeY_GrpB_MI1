function showAlert() {
    alert("Alert!");
}

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
    } else {
        errors.innerHTML = "\n" + errorMessages.join("<strong><h2></h2></strong>") + "\n";
    }
}
