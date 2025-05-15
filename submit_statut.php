<?php 
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: main.php");
    exit;
}

$file = '../data/data_utilisateur.json';
$modif = false;

if (file_exists($file) && filesize($file) > 0) {
    $jsonData = json_decode(file_get_contents($file), true);
    
    if ($jsonData === null) {
        die("Erreur lors de la lecture du fichier JSON.");
    }

    $user_email = $_SESSION['user']['email'];
	

    foreach ($jsonData as &$user) { 
        if ($user['email'] == $user_email) {

            // Mise à jour des informations
            $user['role'] = $statut;
           

            // Mise à jour de la session
            $_SESSION['user'] = $user;
            $modif = true;
            break;
        }
    }

    if ($modif) {
        file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT));
		echo str_replace(['@', '.'], '_', $user['email']);
    }
} else {
    die("Erreur !! Fichier JSON introuvable ou vide.");
}

header("Location: administrateur.php");
exit();
?>