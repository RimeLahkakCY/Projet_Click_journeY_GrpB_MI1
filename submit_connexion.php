<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "L'email n'est pas valide.";
    exit;
}

$data = array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'mdp' => $mdp
    );

$file = 'data.json';

if(file_exists($file)){
    $jsonData = json_decode(file_get_contents($file), true);
    
    foreach($jsonData as $user){
    	if($user['nom'] == $nom && $user['prenom'] == $prenom && $user['email'] == $email && $user['mdp'] == $mdp){
    		echo "Vous êtes connecter. Bienvenue $nom !";
    		exit;
    	}
    }
    
}else{
	echo "Erreur!! fichier vide";
	exit;
}

echo "Connexion impossible : vous n'etes pas inscrit au site :/ ";


?>
