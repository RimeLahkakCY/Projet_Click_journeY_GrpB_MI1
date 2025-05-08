<?php 
 
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    //echo "L'email n'est pas valide.";
    header("Location: inscription.php");
    exit;
}

$file = '../data/data_utilisateur.json';

if(file_exists($file)){
    $jsonData = json_decode(file_get_contents($file), true);
    
    foreach($jsonData as $user){
    	if($user['email'] == $email || $user['mdp'] == $mdp){
    		//echo "l'email ou mot de passe déjà pris. Veuillez en choisir un autre.";
            	header("Location: inscription.php");
    		exit();
    	}
    }
    
}else{
	echo "Erreur!! fichier vide";
}
    
$newId = count($jsonData) + 1;

$data = array(
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email,
    'mdp' => $mdp,
    'role' => "user",
    'id' => strval($newId),
    'favori' => "",
);

$jsonData[] = $data;

file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
header("Location: connexion.php");
exit();
?>
