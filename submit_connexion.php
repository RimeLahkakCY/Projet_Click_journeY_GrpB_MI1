<?php

session_start();

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //echo "L'email n'est pas valide.";
    header("Location: connexion.php");
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
    	if($user['nom'] == $nom && $user['prenom'] == $prenom && $user['email'] == $email && $user['mdp'] == $mdp){
    		
            $_SESSION['user'] = [
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'mdp' => $user['mdp'],
                'role' => $user['role'],
                'id' => $user['id'],
                'favori' => $user['favori'],
            ];
            
            if($user['role'] == "admin"){
                header("Location: administrateur.php");
                exit;
            }else if($user['role'] == "user"){
                header("Location: main.php");
                exit;
            }
    	}
    }
    
}else{
	echo "Erreur!! fichier vide";
	exit;
}

header("Location: connexion.php");
?>
