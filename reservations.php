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

                <!--
                <div style="width: 100%; text-align: center">
                    <iframe width="50%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                    src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                    <a href="https://www.gps.ie/">gps drone</a></iframe>
                </div>	
                
                -->
                
               	<h1 class="titre">Nos voyages</h1>
				<center>

				<table class="info">
					<tr>
						<td class="illustration">
							<img src="https://www.donatello.fr/wp-content/uploads/2019/02/cote-amalfite-2-607x384.jpg" alt="img" height="200px"/> 
						</td>
						<td>
							<h1>Italie: Week-end en amoureux</h1>
							<p>Des villes pleines de charme, des paysages sublimes, une cuisine irrésistible et une atmosphère envoûtante. Un itinéaire qui mélange romantisme, culture et paysages à couper le souffle.</p>
							<h2>Dès 515 $</h2>
							<h2>2 jours</h2>
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
							<p>De Naples à Pompéi & Vésuve</p>
						</td>
					</tr>
					
					<tr>
						<td>
							<input type="submit" name="ok" value="Réserver" class="champ"/> 
						</td>
					</tr>
				</table>

                <table class="info">
					<tr>
						<td class="illustration">
							<img src="https://ulysse.com/news/wp-content/uploads/2024/05/Sydney-en-Australie-.jpg" alt="img" height="200px"/> 
						</td>
						<td>
							<h1>Australie: Vers la liberté</h1>
							<p>L'Australie est une terre d’aventure aux paysages époustouflants : plages paradisiaques, déserts rouges infinis, forêts tropicales luxuriantes et faune unique. Ce road trip te fera découvrir l’Outback, la Great Ocean Road et bien plus encore !</p>
							<h2>Dès 979 $</h2>
							<h2>6 jours</h2>
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
							<p>De Sydney, Great Ocean Road, Adelaide & Kangaroo Island à Uluru & le Red Centre</p>
						</td>
					</tr>
					
					<tr>
						<td>
							<input type="submit" name="ok" value="Réserver" class="champ"/> 
						</td>
					</tr>
				</table>

                <table class="info">
					<tr>
						<td class="illustration">
							<img src="https://www.etapes-ethiopiennes.com/app/uploads/sites/13/2019/08/hauts-plateaux-witr.jpeg" alt="img" height="200px"/> 
						</td>
						<td>
							<h1>Ethiopie: En pleine nature</h1>
							<p>Pour ceux qui rêvent de grands espaces, de paysages à couper le souffle. Et d’une nature encore préservée et éblouissante pour se ressourcer</p>
							<h2>Dès 730 $</h2>
							<h2>6 jours</h2>
						</td>
					</tr>
					
					<tr>
						<td colspan="2">
							<p>Du Parc national du Simien, Lalibela, Retour à Addis-Abeba</p>
						</td>
					</tr>
					
					<tr>
						<td>
							<input type="submit" name="ok" value="Réserver" class="champ"/> 
						</td>
					</tr>
				</table>
				</center>

        </div>
        

        <div class="footer">
                    <div style="display:flex; justify-content: space-between">
                        
                        <div style="background-color:rgb(249, 249, 249, 0.7); height: 80px;">
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
