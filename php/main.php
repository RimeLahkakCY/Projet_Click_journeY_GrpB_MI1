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

        <div class="content">

            <?php if (isset($_SESSION['user'])): ?>
                <h1 class="titre">Bienvenue <?php echo $_SESSION['user']['prenom']?> !</h1>
            <?php else: ?>
                <h1 class="titre">Trouvez votre roadtrip idéal !</h1>
            <?php endif; ?>

            <div class="part1">
                <a href="#ancre1">Qui sommes-nous ?</a>
                <a href="#ancre2">Nos services</a>
                <a href="#ancre3">Notre équipe</a>

                <div>
                    <h1 id="ancre1">Qui sommes-nous :</h1>
                    <p>Wheel Wonder est une agence de voyages spécialisée dans l'organisation de roadtrips inoubliables
                        ! Nous proposons une sélection de séjours soigneusement conçus, avec des étapes déjà planifiées
                        pour garantir une expérience sans stress et riche en découvertes.</p>

                    <h1 id="ancre2">Nos services :</h1>
                    <p>Nous vous offrons des voyages sur-mesure adaptés à vos envies, dans de nombreux pays à travers le
                        monde. Que vous soyez en quête de liberté ou de conseils personnalisés, nous vous accompagnons
                        pour planifier votre road-trip en toute sérénité, en prenant en charge tous les détails de votre
                        itinéraire.</p>

                    <h1 id="ancre3">Notre équipe :</h1>
                    <p>Ce site a été conçu avec passion par Rime, Norah et Asmaa, une équipe dédiée à faire de vos
                        aventures sur la route une expérience unique et mémorable.</p>

                </div>
                <br/><br/>
                <center>
			
		<h1 style="color:blue">Nos sélections du moment : </h1>
			
                <div class="voyages">
                <br/>
                <?php
			$voyages = json_decode(file_get_contents("../data/data_voyages.json"), true);
			$etapes = json_decode(file_get_contents("../data/data_etapes.json"), true);
			$_SESSION['voyages']=$voyages;
			$i=0;
			foreach($voyages as $voyage){
			
		?>
		<div class="thumbnail">
			<div>
				<img src="<?php echo $voyage['photo'];?>" alt="img" height="200px"/>   
			</div>
			<div>
				<h1><?php echo $voyage['titre'];?></h1>
				<p><?php echo $voyage['description'];?></p>
				<h3>Dès <?php echo $voyage['prix'];?>$</h3>
				<h3><?php echo $voyage['duree'];?> jours, 
                <?php foreach ($etapes as $item){
                    if($voyage['lieux'] == $item['lieux']){
                        echo "en ".$item['lieux'];
                    }
                }
                ?>

			</div>
			</div>
			</br></br>
			<?php
			
			if($i==2){
				break;
			}
			$i++;
			}
			?>
            </div>
            </div>
        <center>
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
