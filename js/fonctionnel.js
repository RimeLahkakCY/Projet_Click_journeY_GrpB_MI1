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
    
function prix_reservation(v,d){
 	for(var i of document.getElementsByName('activities[]')){
 	if(i.checked){
 		if(i.value=='musée'){
 			v=v+30;
 		}
 		if(i.value=='restauration'){
 			v=v+10;
 		}
		if(i.value=='randonnée'){
 			v=v+5;
 		}
 		if(i.value=='visite historique'){
 			v=v+20;
 		}
		if(i.value=='croisière'){
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
 		if(q.value=='hôtel'){
 			v=v+30;
 		}
		if(q.value=='camping'){
 			v=v+10;
 		}
 		if(q.value=='hébergement écoresponsable'){
 			v=v+5;
 		}
		if(q.value=='location'){
 			v=v+20;
 		}
		else{
			v=v+50;
		}
 	}
 	}
	
	var depart=document.getElementById('depart').value;
	var retour=document.getElementById('retour').value;
	var tab_depart=depart.split("-");
	var tab_retour=retour.split("-");
	var an=tab_retour[0]-tab_depart[0];
	var mois=tab_retour[1]-tab_depart[1];
	var j=tab_retour[2]-tab_depart[2];
	var duree=(an*365)+(mois*30)+j;
	document.getElementById('duree').innerHTML=duree+" jours";
	document.getElementById('prix_duree').innerHTML=(duree*d)+" $";
	
 	v=v+(duree*d);
 	document.getElementById('ssttl').innerHTML=v+" $";
 	document.getElementById('tva').innerHTML=(v* 0.20)+" $";
 	document.getElementById('ttl').innerHTML=(v+(v* 0.20))+" $";
 }   
