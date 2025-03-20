<html> 
     
    <head>
        <meta charset="UTF-8">
        <link href="main.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="logo.png">
	<link href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Calistoga&family=Didact+Gothic&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <title>Projet web</title>
    </head>
    
    <body>
    	
    	    	<div class="header">
                    <div style="display:flex; justify-content: space-between">
                        <span class="titre">
                            <img src="logo.png" alt="logo" height="80px">
                        </span>
                
                        <div class="menu">
                            <div class="lien">
                                <a href="inscription.php">s'inscrire</a>
                            </div>
                            
                            <div class="lien">
                                <a href="connexion.php">se connecter</a>
                            </div>

                            <div class="lien">
                                <a href="utilisateur.php"><img src="https://cdn-icons-png.flaticon.com/128/456/456212.png" alt="profil" height="30px"/></a>
                            </div>
                            
                        </div>
                    </div>
                    
                
                    
        	<div class="navigation">
        		<ul>
                        <div class="dropdown">
    				<a class="dropbtn"><img src="https://cdn-icons-png.flaticon.com/128/2976/2976215.png" alt="profil" height="20px"/></a>
    					<div class="dropdown-content">
      						<a href="main.html">Acceuil</a>
      						<a href="administrateur.php">Admin</a>
      						<a href="utilisateur.php">Paramètre</a>
    					</div>
						</div>
  			   
						<a href="voyages.php"><img src="https://images-na.ssl-images-amazon.com/images/I/41gYkruZM2L.png" alt="icon" height="20px"/></a>
						<a href="reservations.php">Nos voyages</a>

				</ul>  
  			    
            </div>
                        
        	</div>      
            
			
	<div class="all">

        <div style="display: flex;justify-content: center;margin-top: 20px;">

		   
			<form name="inscription" method="post" action="xxx">
                    
                    <fieldset>
                        
                        <legend>Profil</legend>
						
						<center>
						<div class="div1">
							<label for="img">
								<span style="border-radius: 50%"><img src="https://www.freeiconspng.com/thumbs/login-icon/user-login-icon-14.png" alt="profil" height="70px"/></span>
							</label>
							<span><input id="img" type="file" name="image" class="champ" multiple accept="image/*"/></span>
						</div>
						</center>
						<br/> <br/>
<!---https://stackoverflow.com/questions/2855589/replace-input-type-file-by-an-image --->
						
                        <div class="div1">
                            Nom
                        </div>

                        <div class="div2">
                            <input type="text" name="nom" class="champ" maxlength="50" required="true"/>
                        </div><br/>

                        <div class="div1">
                            Prénom
                        </div>

                        <div class="div2">
                             <input type="text" name="prenom" class="champ" maxlength="50" required="true"/>
                        </div><br/>

                        <div class="div1">
                            Email
                        </div>

                        <div class="div2">
                            <input type="email" name="email" class="champ" required="true"/>
                        </div><br/>
						
                        <div class="div1">
                            Confirmer votre e-mail
                        </div>

						<div class="div1">
                            <input type="password" name="mdp2" class="champ" maxlength="10" />
                        </div>
						<br/> <br/> 
                        
                        <div class="div2">
							<input type="submit" name="valider" value="Valider" class="champ"/>
                            <input type="submit" name="modif" value="Modifier" class="champ"/>
                        </div><br/>
						
                    </fieldset>
                    
                </form>
    
        </div>
	</div>	
		<div class="footer">
                    <div style="display:flex; justify-content: space-between">
                        <div style="background-color: rgb(249, 249, 249, 0.7); height: 80px;">
                            <img src="logo.png" alt="logo" height="80px">
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
