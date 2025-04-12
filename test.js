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

function verifForm() {
    var form = document.getElementById('form');
    var nom = document.getElementsByName('nom')[0];
    var prenom = document.getElementsByName('prenom')[0];
    var email = document.getElementsByName('email')[0];
    var mdp = document.getElementsByName('mdp')[0];
    var errors = document.getElementById('errors');

    var correct = true;
    var errorMessages = [];

    // Validate each field
    if (nom.value.trim() === "") {
        errorMessages.push("Champ Nom est vide !");
        nom.style.borderColor = "#e87548";
        nom.focus();
        correct = false;
    } else {
        nom.style.borderColor = "#9de388";
    }

    if (prenom.value.trim() === "") {
        errorMessages.push("Champ Prénom est vide !");
        prenom.style.borderColor = "#e87548";
        prenom.focus();
        correct = false;
    } else {
        prenom.style.borderColor = "#9de388";
    }

    if (email.value.trim() === "") {
        errorMessages.push("Champ Email est vide !");
        email.style.borderColor = "#e87548";
        email.focus();
        correct = false;
    } else {
        email.style.borderColor = "#9de388";
    }

    if (mdp.value.trim() === "") {
        errorMessages.push("Champ Mot de passe est vide !");
        mdp.style.borderColor = "#e87548";
        mdp.focus();
        correct = false;
    } else {
        mdp.style.borderColor = "#9de388";
    }

    if (correct) {
        errors.innerHTML = "";
        form.submit();
    } else {
        //alert("Formulaire incorrect !\n\n" + errorMessages.join("\n"));
        errors.innerHTML = "\n" + errorMessages.join("<strong><h2></h2></strong>") + "\n";
    }
}
