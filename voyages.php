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
						<a href="utilisateur.php"><img src="https://cdn-icons-png.flaticon.com/128/456/456212.png" 
							alt="profil" height="30px"/></a>
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
            
             <div class="all" >

            

	
                <center><fieldset class="recherche">
                            
                            
                            <div  class="bttn">
                            
                            	<span class="container">
      <input type="search" maxlength="10" placeholder="Où allez-vous ?" class="searchbar"/>
      
    </span>
                            
                            <span class="container">
      <input type="date" placeholder="Quel date ?" class="searchbar" />
    </span>
                            
                            <span class="container">
      <input type="number" maxlength="12" placeholder="Voyageurs" class="searchbar" min="1" max="16"/>
    </span>
    			    <span class="bttnrchrch">
      <button type="button" class="rchrch"><img src="https://images-na.ssl-images-amazon.com/images/I/41gYkruZM2L.png" alt="search icon" class="buttonSearch"/></button>
    </span>
                            
                            </div>
                            </fieldset></center>
                             <div style="display: flex;justify-content: center;margin-top: 20px;">
                            <div style="display: flex; justify-content: space-between">
                            	<div class="filtres">
                            		
                            		<h1> Filtres </h1>
                            		
                            		
                                	<span>Pays</span><br/>
                            		
                            		<div class="div2">
                                		<select name="pays" size="5" multiple="multiple">
                                		<option value="France">France</option>
                                		<option value="Belgique">Belgique</option>
                                		<option value="Allemagne">Allemagne</option>
                                		<option value="USA">USA</option>
                                		<option value="RDC">RDC</option>
                                		</select>
                            		</div><br/>
                            		
                            		<span>Voitures</span><br/>
                            		
                            		<div class="div2">
                                		<select name="voiture" multiple="multiple">
                                		<option value="Peugot">Peugot</option>
                                		<option value="Wolswagen">Wolswagen</option>
                                		<option value="Tesla">Tesla</option>
                                		<option value="Citroen">Citroen</option>
                                		</select>
                            		</div><br/>
                            		
                            		<span>Budget</span><br/>
                            		
                            		<div class="div2">
                                		<input type="checkbox" name="budget" value="50a100" class="champ"/>50-100<br/><br/>
                                		<input type="checkbox" name="budget" value="50a100" class="champ"/>100-200<br/><br/>
                                		<input type="checkbox" name="budget" value="50a100" class="champ"/>200-500<br/><br/>
                                		<input type="checkbox" name="budget" value="50a100" class="champ"/>500-1000<br/><br/>
                                		<input type="checkbox" name="budget" value="50a100" class="champ"/>1000-1500<br/><br/>
                            		</div><br/>
                            
                           
                            
                            		<div class="div2">
                                		<input type="submit" name="ok" value="valider" class="champ"/> 
                            		</div><br/>
                            		
                            	</div>
                            	
                            	<div class="voyages">
									
									<a href="reservations.php">
									<div class="thumbnail">
									<div>
										<img src="https://ulysse.com/news/wp-content/uploads/2024/05/Sydney-en-Australie-.jpg" alt="img" height="200px"/>   
									</div>
									<div>
										<h1>Australie: Vers la liberté</h1>
										<p>L'Australie est une terre d’aventure aux paysages époustouflants : plages paradisiaques, déserts rouges infinis, forêts tropicales luxuriantes et faune unique. Ce road trip te fera découvrir l’Outback, la Great Ocean Road et bien plus encore !</p>
										<h3>Dès 979 $</h3>
										<h3>6 jours, de Sydney, Great Ocean Road, Adelaide & Kangaroo Island à Uluru & le Red Centre</h3>

									</div>
									</div>
									</a>
									</br></br>
									
									<a href="reservations.php">
									<div class="thumbnail">
									<div>
										<img src="https://www.donatello.fr/wp-content/uploads/2019/02/cote-amalfite-2-607x384.jpg" alt="img" height="200px"/>   
									</div>
									<div>
										<h1>Italie: Week-end en amoureux</h1>
										<p>Des villes pleines de charme, des paysages sublimes, une cuisine irrésistible et une atmosphère envoûtante. Un itinéaire qui mélange romantisme, culture et paysages à couper le souffle.</p>
										<h3>Dès 515 $</h3>
										<h3>2 jours, de Naples à Pompéi & Vésuve</h3>
									</div>
									</div>
									</a>
									</br></br>
									
									<a href="reservations.php">
									<div class="thumbnail">
									<div>
										<img src="https://www.etapes-ethiopiennes.com/app/uploads/sites/13/2019/08/hauts-plateaux-witr.jpeg" alt="img" height="200px"/>   
									</div>
									<div>
										<h1>Ethiopie: En pleine nature</h1>
										<p>Pour ceux qui rêvent de grands espaces, de paysages à couper le souffle. Et d’une nature encore préservée et éblouissante pour se ressourcer</p>
										<h3>Dès 730 $</h3>
										<h3>4 jours, du Parc national du Simien, Lalibela, Retour à Addis-Abeba</h3>
									</div>
									</div>
									</a>
									</br></br>
                            	</div>
                            	
                            
                            </div>
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
            
            
            
<html>
