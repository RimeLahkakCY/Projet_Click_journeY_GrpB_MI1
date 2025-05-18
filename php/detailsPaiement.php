<?php  
    session_start();

    if (!isset($_SESSION['user']) || !isset($_SESSION['paiement'])) {
        header("Location: main.php");
        exit();
    }

    if(!isset($_COOKIE['style'])){
        setcookie("style", "main", time() + 360*60, "/");
        $style = "main";
    }else{
        $style = $_COOKIE['style'];
    }

    $dataFile = '../data/data_reservations.json';
    $data = [];
    $userId = $_SESSION['user']['id'];
    $reservation = $_SESSION['paiement'];
    
    $montant = $_GET['montant'];
    $statut = $_GET['status'];
    
    //print_r($statut);
    

    //print_r($_SESSION['paiement']);

    if (file_exists($dataFile)) {
        $data = json_decode(file_get_contents($dataFile), true);
        $userFound = false;

        foreach ($data as &$userData) {
            if ($userData['user_id'] == $userId) {
                $userFound = true;
                $found = false;
                foreach ($userData['reservations'] as &$res) {
                    if ($res['id'] == $reservation['id']) {
                        $res = $reservation;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $userData['reservations'][] = $reservation;
                }
                break;
            }
        }

        if (!$userFound) {
            $data[] = [
                'user_id' => $userId,
                'reservations' => [$reservation]
            ];
        }
    }

    if($statut === 'accepted'){
        file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    if(isset($_POST['retour_accueil'])){
        unset($_SESSION['paiement']);
        header("Location: main.php");
        exit();
    }else if(isset($_POST['retour_voyage'])){
        header("Location: location-recpitulatif.php?i=" . $reservation['id']);
        exit();
    }
        
?>

<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/<?php echo $style; ?>.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Calistoga&family=Didact+Gothic&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Projet web</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/fonctionnel.js"></script>
    <script type="text/javascript" src="../js/visual.js"></script>
</head>
    
    <body>
        <div class="header">
            <div style="display:flex; justify-content: space-between">
                <span class="titre">
                    <img src="../img/logo.png" alt="logo" height="80px">
                </span>

                <div class="menu">
                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="lien">
                            <a href="deconnexion.php">Se déconnecter</a>
                        </div>
                        <div class="lien">
                            <a href="utilisateur.php"><img src="../img/profil.png" alt="profil" height="30px" /></a>
                        </div>
                    <?php else: ?>
                        <div class="lien">
                            <a href="connexion.php">Se connecter</a>
                        </div>
                        <div class="lien">
                            <a href="inscription.php">S'inscrire</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="navigation">
                <ul>
                    <div class="dropdown">
                        <a class="dropbtn"><img src="../img/dropdown.png" alt="profil"
                            height="20px" /></a>
                        <div class="dropdown-content">
                            <a href="main.php">Acceuil</a>
                            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == "admin"):?>
                                <a href="administrateur.php">Admin</a>
                            <?php endif; ?>
                            <a href="utilisateur.php">Paramètre</a>
                        </div>
                    </div>

                    <a href="voyages.php"><img src="../img/search.png"
                        alt="icon" height="20px" /></a>
                
                </ul>
                <div style="display: flex; justify-content: space-between; margin: 15px;">
            	<?php if (isset($_COOKIE['style'])):?>
			    <img class="mode" id="mode" onclick="color();" height="25px" src="../img/dark_mode.png"/>
	    	    <?php endif; ?>
                <img class="mode" id="musicButton" onclick="musicBox();" height="25px" src="../img/musicOn.png"/>
                </div>
                
            </div>
        </div>
        
        <div class="all">
            <div class="slideshow"></div>
                <div class="content">               
                    <fieldset style="height:600px; width:700px">
                        
                        <?php if($statut === 'accepted'){
                            echo "<legend>Votre réservation a bien été enregistrée
                             <img height='30px' src='../img/marque.png'/></legend>";
                        }else{
                            echo "<legend>Votre réservation n'a pas été enregistrée 
                            <img height='30px' src='../img/croix.png'/></legend>";
                        }
                        ?>
                        
                        <div class="thumbnail">
                                <?php 
                                  $reservation = $_SESSION['paiement'];
                                  
                                echo "<div style='margin 20px ;padding: 10px; color: white'>";
                                
                                echo "<p>Séjour : ".$reservation['title']. "</p>";
                                echo "<p>Pays : ".$reservation['place']. "</p>";
                                echo "<p>Modèle voiture : ".$reservation['car_model']. "</p>";
                                echo "<p>Classe voiture : ".$reservation['car_class']. "</p>";
                                echo "<p>Début : ".$reservation['pickup_date']. "</p>";
                                echo "<p>Fin : ".$reservation['return_date']. "</p>";
                             
                             
                                echo "<p>Options : ".implode(",",array_values($reservation['options'])). "</p>";
                                echo "<p>Activités : ".implode(",",array_values($reservation['activities'])). "</p>";
                                echo "<p>Hébergements : ".implode(",",array_values($reservation['accommodation'])). "</p>";
                                
                                echo "<p>Montant total : ".$montant. " $</p>";
                      
                                echo "</div><br>";

                          
                                ?>
                            </div>

                           <form method="POST">
                                   <?php if($statut === 'accepted'){
                                   echo "<input style='margin: 20px;' class='btn btn-primary' type='submit' name='retour_accueil' value='Retour Accueil'> " ;  
                                   }else if($statut === 'denied'){
                                   echo "<input style='margin: 20px;' class='btn btn-primary' type='submit' name='retour_voyage' value='Retour Voyage'> "  ;
                                   }?>
                                  
                              </form>
                    
                    </fieldset>
            
                </div>
            

        </div>

        <div class="footer">
        <div style="display:flex; justify-content: space-between">

            <div style="background-color: rgb(249, 249, 249, 0.7); height: 80px;">
                <img src="../img/logo.png" alt="logo" height="80px">
            </div>

            <div>
                <h3>Qui sommes-nous ?</h3>
                <h4>Nos services</h4>
                <h4>Notre équipe</h4>
                <h4>Voyage sur-mesure</h4>
            </div>

            <div>
                <h3>Top destinations</h3>
                <h4>France</h4>
                <h4>Italie</h4>
                <h4>Japon</h4>
                <h4>Etats-Unis</h4>
                <h4>Australie</h4>
            </div>

            <div>
                <h3>Idées voyages</h3>
                <h4>En solo</h4>
                <h4>En couple</h4>
                <h4>Entre amis</h4>
                <h4>Déconnecter</h4>
            </div>
            
        </div>
	           
        <div>
            <a href="https://orteil.dashnet.org/cookieclicker/" target="_blank" ><img src="../img/cookie.png"alt="icon" style="height: 30px" />Accepter cookie?</a> 
        </div>
    </body>
</html>
