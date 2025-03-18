<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];


$data = array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'mdp' => $mdp
    );

$file = 'data.json';

if(file_exists($file)){
    $jsonData = json_decode(file_get_contents($file), true);
}else{
	echo "Erreur!! fichier vide";
}
    
$jsonData[] = $data;

file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT));
echo "Merci, votre message a été envoyé !";

?>
