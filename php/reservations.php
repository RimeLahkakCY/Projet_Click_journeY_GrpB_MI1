<?php
session_start();

$i = isset($_GET['i']) ? (int) $_GET['i'] : 0;

if ($i < 0 || !isset($_SESSION['user'])){
    header("Location: voyages.php");
    exit();
}

$etapes = json_decode(file_get_contents("../data/data_etapes.json"), true);
$_SESSION['etapes'] = $etapes;

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
                        <a href="utilisateur.php"><img src="https://cdn-icons-png.flaticon.com/128/456/456212.png"
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

				<center>
					<h1 class="titre">Nos voyages</h1>
					
							<table class="info">
								<tr>
									<td class="illustration">
										<img src="<?php echo $_SESSION['voyages'][$i]['photo']; ?>" alt="img" height="200px"/> 
									</td>
									<td>
										<h1><?php echo $_SESSION['voyages'][$i]['titre']; ?></h1>
										<p><?php echo $_SESSION['voyages'][$i]['description']; ?></p>
										<h2>Dès <?php echo $_SESSION['voyages'][$i]['prix']; ?>$</h2>
										<h2><?php echo $_SESSION['voyages'][$i]['duree']; ?> jours</h2>
									</td>
								</tr>
		
								<tr>
									<td colspan="2">
										<p>Lieux: <?php echo $_SESSION['voyages'][$i]['lieux']; ?></p>
                                        <p>Etapes :<?php foreach ($_SESSION['etapes'][$i]['ville'] as $etape){ ?>
                        					<?php echo $etape ?>,
                    					<?php } ?></p>
                                        
									</td>
								</tr>
		
								<tr>
									<td>
										<a href="location-recpitulatif.php?i=<?php echo $i; ?>"><input type="submit" name="ok" value="Réserver" class="champ"/><a/>
									</td>
								</tr>
							</table>
				
				</center>

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
