<?php
    session_start(); 

    if(!isset($_COOKIE['style'])){
		setcookie("style", "main", time() + 360*60, "/");
		$style = "main"; 
	}else{
		$style = $_COOKIE['style'];
	} 

    if (!isset($_SESSION['user'])){
        header("Location: main.php");
        exit();
    }

    $editeur = isset($_GET['modifier']);

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
                        <a href="utilisateur.php"><img src="../img/profil.png"
                            alt="profil" height="30px" /></a>
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
			<img class="mode" id="mode" onclick="color();" height="25px" src="../img/main_mode.png"/>
	    	<?php endif; ?>
                <img class="mode" id="musicButton" onclick="musicBox();" height="25px" src="../img/musicOn.png"/>
            </div>

        </div>

    </div>
			
	<div class="all">
        <div class="slideshow"></div>                        
        <div style="display: flex;justify-content: center; align-items: stretch; margin: 80px;">

		   
			<form name="inscription" id="form" method="POST">
                    
                    <fieldset>
                        
                        <legend>Profil</legend>
						
						<div class="div1">
							<label for="img">
								<span style="border-radius: 50%"><img src="../img/profil.png" alt="profil" height="70px"/></span>
							</label>
							<span><input id="img" type="file" name="image" class="champ" multiple accept="image/*"/></span>
						</div>
						<br/><br/>

                        <div class="div1">
                            Nom :
                        </div>
						
                        <div class="div2">
                            <input type="text" name="nom" value="<?php echo $_SESSION['user']['nom']?>" readOnly><br>
                            <img class="eye" onclick="modifier('nom');" src="../img/modify.png" id="modif" alt="modifier" height=20px;>
                            <div class="boutons_user" style="display: none;">
                                <img class="eye" type="button" onclick="annuler('nom');" src="../img/cancel.png" alt="annuler" height=20px;>
                                <img class="eye" type="button" onclick="valider('nom');" src="../img/valid.png" alt="valider" height=20px;>
                            </div>
                        </div><br/>

                        <div class="div1">
                            Prénom :
                        </div>

                        <div class="div2">
                            <input type="text" name="prenom" value="<?php echo $_SESSION['user']['prenom']?>" readOnly><br>
                            <img class="eye" onclick="modifier('prenom');" src="../img/modify.png" id="modif" alt="modifier" height=20px;>
                            <div class="boutons_user" style="display: none;">
                                <img class="eye" type="button" onclick="annuler('prenom');" src="../img/cancel.png" alt="annuler" height=20px;>
                                <img class="eye" type="button" onclick="valider('prenom');" src="../img/valid.png" alt="valider" height=20px;>
                            </div>
                        </div><br/>

                        <div class="div1">
                            E-mail :
                        </div>

                        <div class="div2"> 
                            <input type="email" name="email" value="<?php echo $_SESSION['user']['email']?>" readOnly><br>
                            <img class="eye" onclick="modifier('email');" src="../img/modify.png" id="modif" alt="modifier" height=20px;>
                            <div class="boutons_user" style="display: none;">
                                <img class="eye" type="button" onclick="annuler('email');" src="../img/cancel.png" alt="annuler" height=20px;>
                                <img class="eye" type="button" onclick="valider('email');" src="../img/valid.png" alt="valider" height=20px;>
                            </div>
                        </div><br/>

                        <div class="div1">
                            Mot de passe :
                        </div>

                        <div class="div2">
                            <input type="password" name="mdp" value="<?php echo $_SESSION['user']['mdp']?>" readOnly><br>
                            <img class="eye" id="eye" onclick="showPassword();" height=20px src="../img/eye_closed.png"/>
                            <img class="eye" onclick="modifier('mdp');" src="../img/modify.png" id="modif" alt="modifier" height=20px;>
                            
                            <div class="boutons_user" style="display: none;">
                                <img class="eye" type="button" onclick="annuler('mdp');" src="../img/cancel.png" alt="annuler" height=20px;>
                                <img class="eye" type="button" onclick="valider('mdp');" src="../img/valid.png" alt="valider" height=20px;>
                            </div>
                        </div><br/>

                        <div class="soumettre">
                            <!--<button type="submit" id="user_submit" onclick="verifForm();" style="display:none;">Soumettre</button>-->
                            <button type="button" id="user_submit" style="display:none;">Soumettre</button>
                        </div><br>
                        
                        <span id="errors" class="error-messages" style="color:rgb(221, 54, 42); padding: 15px; margin : 10px"></span>
						
                    </fieldset>
                    
                </form>

                <div class="reservation">
                    <h1>Mes réservations</h1>
                    <div class="conteneur-voyages">
                        <?php 
                          $reservFile = "../data/data_reservations.json";
                          $existe_reserv = false;
                          if(file_exists($reservFile)){
                            $reservations = json_decode(file_get_contents($reservFile),true);  

                            foreach($reservations as $reservation){
                                if($reservation['user_id'] == $_SESSION['user']['id']){
                                    foreach($reservation['reservations'] as $reserv){
                                    	$existe_reserv = true;
                                        echo "<div class='reservation'>";
                                        echo "<p>Séjour : ".$reserv['title']. "</p>";
                                        echo "<p>Pays : ".$reserv['place']. "</p>";
                                        echo "<p>Modèle voiture : ".$reserv['car_model']. "</p>";
                                        echo "<p>Classe voiture : ".$reserv['car_class']. "</p>";
                                        echo "<p>Début : ".$reserv['pickup_date']. "</p>";
                                        echo "<p>Fin : ".$reserv['return_date']. "</p>";
                                       
                                        echo "<p>Options : ".implode(",",array_values($reserv['options'])). "</p>";
                                        echo "<p>Activités : ".implode(",",array_values($reserv['activities'])). "</p>";
                                        echo "<p>Hébergements : ".implode(",",array_values($reserv['accommodation'])). "</p>";
                                        
                                        echo "</div><br>";
                                    }
                                }
                            }  
                          }
                          
                          if(!$existe_reserv){
                                	echo "<p>Aucune réservation trouvée.</p>";
                                }

                        ?>
                    </div>
                </div>
    
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
                    
        </div>
    	
    </body>
    
</html>
