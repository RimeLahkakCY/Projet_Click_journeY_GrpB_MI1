<?php 
session_start();
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
            </div>
        </div>
        
        <div class="all">
            <center>
                <form method="GET" action="voyages.php">
                    <fieldset class="recherche">
                        <div class="bttn">
                            <span class="container">
                                <input type="search" maxlength="10" placeholder="Où allez-vous ?" class="searchbar" name="recherche"/>
                            </span>

                            <span class="container">
                                <input type="date" placeholder="Quel date ?" class="searchbar" name="date"/>
                            </span>

                            <span class="container">
                                <input type="number" maxlength="12" placeholder="Voyageurs" class="searchbar" min="1" max="16" name="voyageurs"/>
                            </span>

                            <span class="bttnrchrch">
                                <button type="submit" class="rchrch"><img src="../img/search.png" alt="search icon" class="buttonSearch"/></button>
                            </span>
                        </div>
                    </fieldset>
                </form>
            </center>
            
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
                            <input type="checkbox" name="budget[]" value="50a100" class="champ"/>50-100<br/><br/>
                            <input type="checkbox" name="budget[]" value="100a200" class="champ"/>100-200<br/><br/>
                            <input type="checkbox" name="budget[]" value="200a500" class="champ"/>200-500<br/><br/>
                            <input type="checkbox" name="budget[]" value="500a1000" class="champ"/>500-1000<br/><br/>
                            <input type="checkbox" name="budget[]" value="1000a1500" class="champ"/>1000-1500<br/><br/>
                        </div><br/>

                        <div class="div2">
                            <input type="submit" name="ok" value="valider" class="champ"/> 
                        </div><br/>
                    </div>

                    <div class="voyages">
                        <?php
                        $voyages = json_decode(file_get_contents("../data/data_voyages.json"), true);
                        $etapes = json_decode(file_get_contents("../data/data_etapes.json"), true);
                        $_SESSION['voyages'] = $voyages;
                        $i = 0;
                        $resultat = false;

                        foreach($voyages as $voyage){
                            
                            if (!isset($_GET['recherche']) || empty($_GET['recherche']) || stripos($voyage['lieux'], $_GET['recherche']) !== false) {
                                $resultat = true;
                                ?>
                                <a href="reservations.php?i=<?php echo $voyage['id']; ?>">
                                    <div class="thumbnail">
                                        <div>
                                            <img src="<?php echo $voyage['photo']; ?>" alt="img" height="200px"/>
                                        </div>
                                        <div>
                                            <h1><?php echo $voyage['titre']; ?></h1>
                                            <p><?php echo $voyage['description']; ?></p>
                                            <h3>Dès <?php echo $voyage['prix']; ?>$</h3>
                                            <h3><?php echo $voyage['duree']; ?> jours, <?php
                                                foreach ($etapes as $item) {
                                                    if($voyage['lieux'] == $item['lieux']){
                                                        echo "en ".$item['lieux'];
                                                    }
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                    </div>
                                </a>
                                <br/><br/>
                                <?php
                                $i++;
                            }
                        }

                        if (!$resultat) {
                            echo '<h2 style="color:white; margin:20px">Aucun voyage ne correspond à ce mot-clé</h2>';
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
