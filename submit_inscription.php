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

$file = 'data_utilisateur.json';

if(file_exists($file)){
    $jsonData = json_decode(file_get_contents($file), true);
    
    foreach($jsonData as $user){
    	if($user['email'] == $email || $user['mdp'] == $mdp){
    		echo "l'email et/ou mot de passe est déjà pris";
    		exit;
    	}
    }
    
}else{
	echo "Erreur!! fichier vide";
}
    
$jsonData[] = $data;

file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT));
echo "Merci, votre inscription a été envoyé !";
?>
