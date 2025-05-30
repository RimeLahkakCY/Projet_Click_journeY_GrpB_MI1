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
        //form.submit();
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
    input.readOnly = false;
    boutons.style.display = 'flex';

    document.getElementById("user_submit").style.display = 'none';
}

function annuler(champ) {
    var input = document.querySelector(`input[name="${champ}"]`);
    var boutons = input.parentElement.querySelector('.boutons_user');

    input.value = input.dataset.val_initial;
    input.readOnly = true;
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

function prix_reservation(v,d,t){

 			for(var i of document.getElementsByName('activities[]')){
 				if(i.checked){
 				if(i.value == 'musée'){
 					v=v+30;
 				}
 				if(i.value == 'restauration'){
 					v=v+10;
 				}
				if(i.value == 'randonnée'){
 					v=v+5;
 				}
 				if(i.value == 'visite historique'){
 					v=v+20;
 				}
				if(i.value == 'croisière'){
 					v=v+40;
 				}
				else{
					v=v+50;
				}
 			}
 		}
 	for(var j of document.getElementsByName('options[]')){
 	if(j.checked){
 		v=v+10;
 	}
 	}
	for(var k of document.getElementsByName('assurance')){
 	if(!k.checked){
 		v=v-10;
 	}
 	}
	for(var q of document.getElementsByName('accommodation')){
 	if(q.checked){
 		if(q.value == 'hôtel'){
 			v=v+30;
 		}
		if(q.value == 'camping'){
 			v=v+10;
 		}
 		if(q.value == 'hébergement écoresponsable'){
 			v=v+5;
 		}
		if(q.value == 'location'){
 			v=v+20;
 		}
		else{
			v=v+50;
		}
 	}
 	}
	
 	document.getElementById('ssttl').innerHTML=v+" $";
 	document.getElementById('tva').innerHTML=(v* 0.20)+" $";
 	document.getElementById('ttl').innerHTML=(v+(v* 0.20))+" $";
}

function Dretour(t){

	var depart = new Date(document.getElementById('depart').value);
	var retourDate = document.getElementById('retour');

	depart.setDate(depart.getDate() + parseInt(t));
	retourDate.innerHTML = depart.toLocaleDateString();
}


$(document).ready(function(){

	$("#user_submit").click(function(){

		if(verifForm()){
			$.post("../php/submit_modification.php",
			{
		 		nom: document.getElementsByName('nom')[0].value,
    			prenom: document.getElementsByName('prenom')[0].value,
    			email: document.getElementsByName('email')[0].value,
    			mdp: document.getElementsByName('mdp')[0].value
    			
			}, function(data, status){
				if(status === 'success'){
				
					document.querySelectorAll('input').forEach(input => {
                    input.readOnly = true;
                    });
                    document.querySelectorAll('.boutons_user').forEach(btn => {
                    btn.style.display = 'none';
                    });

                    document.getElementById("user_submit").style.display = 'none';
					console.log("Success");
					
				}else{
					console.log("Failed");
				}
			}
			);
		}
	});
});

$(document).ready(function(){
    $(".champ").click(function(e){
        e.preventDefault();

        const form = $(this).closest("form"); // ← très important
        const email = form.find(".email").val();
        const role = form.find(".role").val();

        console.log("Email :", email);
        console.log("Role :", role);

        $.post("../php/submit_statut.php", {
            email: email,
            role: role
        }, function(data, status){
	if(status === 'success'){
            console.log("Modification envoyée :", email, role);
	    return true;
	}
	else{
	    console.log("Echec modification");
		return false;
	}
        });
    });
});
