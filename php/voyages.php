<?php 
    session_start();
	
	if(!isset($_COOKIE['style'])){
		setcookie("style", "main", time() + 360*60, "/");
		$style = "main";
	}else{
		$style = $_COOKIE['style'];
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
                <div style="display: flex; align-items: center; margin: 15px;">
            	<?php if (isset($_COOKIE['style'])):?>
		<img class="mode" id="mode" onclick="color();" height="25px" src="../img/dark_mode.png"/>
	    <?php endif; ?>
            </div>
                
            </div>
        </div>
        
        <div class="all">
            <div class="slideshow"></div>
            <center>
                <form method="GET" action="voyages.php">
                    <fieldset class="recherche">
                        <div class="bttn">
                            <span class="container">
                                <input type="search" maxlength="10" placeholder="Où allez-vous ?" class="searchbar" name="recherche"/>
                            </span>

                            <span class="bttnrchrch">
                                <button type="submit" class="rchrch"><img src="../img/search.png" alt="search icon" class="buttonSearch"/></button>
                            </span>
                        </div>
                    </fieldset>
                </form>
            </center> 
            <div style="display: flex;justify-content: center;margin-top: 20px;">             
                <div class="conteneur-voyages">
            
                    <div class="filtres">
                        <h1>Trier par :</h1>

                        <h2>Prix</h2>
                        <select id="prix" onchange="trier();">
                            <option value="">Non trier</option>
                            <option value="prixCroi">Prix croissant</option>
                            <option value="prixDecroi">Prix décroissant</option>
                        </select>
                        <h2>Durée</h2>
                        <select id="duree" onchange="trier();">
                            <option value="">Non trier</option>
                            <option value="dureeCroi">Durée croissante</option>
                            <option value="dureeDecroi">Durée décroissante</option>
                        </select>
                        <h2>Etapes</h2>
                        <select id="etapes" onchange="trier();">
                            <option value="">Non trier</option>
                            <option value="etapesCroi">Nb étapes croissant</option>
                            <option value="etapesDecroi">Nb étapes décroissant</option>
                        </select>
                    </div>

                    <div class="voyages">
                    <?php
                        $voyages = json_decode(file_get_contents("../data/data_voyages.json"), true);
                        $etapes = json_decode(file_get_contents("../data/data_etapes.json"), true);
                        $_SESSION['voyages'] = $voyages;

                        $resultat = [];
                        foreach($voyages as $voyage){
                            if (!isset($_GET['recherche']) || empty($_GET['recherche']) || stripos($voyage['lieux'], $_GET['recherche']) !== false) {
                                $resultat[] = $voyage;
                            }
                        }

                        $nbVoyages = count($resultat);
                        $nbParPages = 3;
                        $nbPages = ceil($nbVoyages / $nbParPages);

                        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                        if($page < 1){
                            $page = 1;
                        }
                        if($page > $nbPages){
                            $page = $nbPages;
                        } 

                        $debut = ($page - 1) * $nbParPages;
                        $resultatsPage = array_slice($resultat, $debut, $nbParPages);

                        if (count($resultatsPage) === 0) {
                            echo '<h2 style="color:white; margin:20px">Aucun voyage ne correspond à ce mot-clé</h2>';
                        } else {
                            foreach($resultatsPage as $voyage){
                                $nbEtapes = 0;
                                foreach ($etapes as $item) {
                                    if ($voyage['lieux'] == $item['lieux']) {
                                        $nbEtapes++;
                                    }
                                }
                                ?>
                            
                                <a href="reservations.php?i=<?php echo $voyage['id']; ?>">
                                    <div class="thumbnail" data-prix="<?= $voyage['prix']; ?>" data-duree="<?= $voyage['duree']; ?>" data-etapes="<?= $nbEtapes; ?>">
                                        <div>
                                            <img src="<?php echo $voyage['photo']; ?>" alt="img" height="200px"/>
                                        </div>
                                        <div>
                                            <h1><?php echo $voyage['titre']; ?></h1>
                                            <p><?php echo $voyage['description']; ?></p>
                                            <h3>Dès <?php echo $voyage['prix']; ?>$</h3>
                                            <h3><?php echo $voyage['duree']; ?> jours, en <?php echo $voyage['lieux']; ?></h3>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                        }
                        ?>

                    <div class="pagination">
                    <a href="?page=<?php echo max(1, $page - 1)?>" class="page"> << </a>
                    <?php
                        for ($j = 0; $j < $nbPages; $j++) {
                            $pageNum = $j + 1;
                            echo "<a href='?page=$pageNum' class='page'>$pageNum</a> ";
                        }
                    ?>
                    <a href="?page=<?php echo min($nbPages, $page + 1)?>" class="page"> >> </a>
                </div>
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
