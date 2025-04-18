<?php
    session_start(); 

    if (!isset($_SESSION['user'])){
        header("Location: main.php");
        exit();
    }

    $editeur = isset($_GET['modifier']);

?>

<html> 
     
    <head>
        <meta charset="UTF-8">
        <link href="../css/main.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../img/logo.png">
        <link
            href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Calistoga&family=Didact+Gothic&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap"
            rel="stylesheet">
        <title>Projet web</title>
        <script type="text/javascript" src="../test.js"></script>
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
        </div>

    </div>
			
	<div class="all">

        <div style="display: flex;justify-content: center;margin-top: 20px; min-height: 700px;">

		   
			<form name="inscription" id="form" method="POST" action="submit_modification.php">
                    
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
                            <input type="text" name="nom" value="<?php echo $_SESSION['user']['nom']?>" disabled><br>
                            <img class="eye" onclick="modifier('nom');" src="../img/modify.png" id="modif" alt="modifier" height=20px;>
                            <img class="eye" type="button" onclick="annuler('nom');" src="../img/cancel.png" alt="annuler" height=20px;>
                            <img class="eye" type="button" onclick="valider('nom');" src="../img/valid.png" alt="valider" height=20px;>
                        </div><br/>

                        <div class="div1">
                            Prénom : 
                        </div>

                        <div class="div2">
                            <input type="text" name="prenom" value="<?php echo $_SESSION['user']['prenom']?>" disabled><br>
                            <img class="eye" onclick="modifier('prenom');" src="../img/modify.png" id="modif" alt="modifier" height=20px;>
                            <img class="eye" type="button" onclick="annuler('prenom');" src="../img/cancel.png" alt="annuler" height=20px;>
                            <img class="eye" type="button" onclick="valider('prenom');" src="../img/valid.png" alt="valider" height=20px;>
                        </div><br/>

                        <div class="div1">
                            E-mail :
                        </div>

                        <div class="div2"> 
                            <input type="email" name="email" value="<?php echo $_SESSION['user']['email']?>" disabled><br>
                            <img class="eye" onclick="modifier('email');" src="../img/modify.png" id="modif" alt="modifier" height=20px;>
                                <img class="eye" type="button" onclick="annuler('email');" src="../img/cancel.png" alt="annuler" height=20px;>
                                <img class="eye" type="button" onclick="valider('email');" src="../img/valid.png" alt="valider" height=20px;>
                        </div><br/>

                        <div class="div1">
                            Mot de passe :
                        </div>

                        <div class="div2">
                            <input type="password" name="mdp" value="<?php echo $_SESSION['user']['mdp']?>" disabled><br>
                            <img class="eye" id="eye" onclick="showPassword();" height=20px src="../img/eye_closed.png"/>
                            <img class="eye" onclick="modifier('mdp');" src="../img/modify.png" id="modif" alt="modifier" height=20px;>
                                <img class="eye" type="button" onclick="annuler('mdp');" src="../img/cancel.png" alt="annuler" height=20px;>
                                <img class="eye" type="button" onclick="valider('mdp');" src="../img/valid.png" alt="valider" height=20px;>
                        </div><br/>

                        <div class="soumettre">
                            <button type="submit" onclick="verifForm();">Soumettre</button>
                        </div>
						
                    </fieldset>
                    
                </form>
    
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

                        <div>
                            <h3>Top destinations</h3>
                            <h4>France</h4>
                            <h4>Italie</h4>
                            <h4>Belgique</h4>
                        </div>
                    </div>
                    
        </div>
    	
    </body>
    
</html>
