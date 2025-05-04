<?php
    session_start(); 
    
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
        header("Location: main.php");
        exit();
    }
    
    $file = "../data/data_utilisateur.json";
    
    if(file_exists($file)){
    	$users = json_decode(file_get_contents($file), true);
    }else{
    	die("il n'y a pas de fichier utilisateur");
    }
?>

<html>
      
    <head>
        <meta charset="UTF-8">
        <link href="../css/main.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../img/logo.png">
        <link
            href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Calistoga&family=Didact+Gothic&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap"
            rel="stylesheet">
        <script type="text/javascript" src="../test.js"></script>
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
        <div class="slideshow"></div>
		<center>
    	<h1 class="titre">Administration</h1>
		
		<table class="admin">
			<thead>
				<th>Nom</th>
				<th>Prenom</th>
                <th>E-mail</th>
				<th>Statut</th>
			</thead>
			<tbody>
				<?php

                $nbUsers = count($users);
                $nbParPage = 4;
                $nbPages = ceil($nbUsers / $nbParPage);
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;  
                
                if ($page < 1){
                    $page = 1;
                } 
                if ($page > $nbPages){
                    $page = $nbPages;
                }

                $debut = ($page - 1) * $nbParPage;
                $usersPage = array_slice($users,$debut,$nbParPage);

				foreach($usersPage as $user){
                    $cleanEmail = str_replace(['@', '.'], '_', $user['email']);
				?>
					
					<tr>
						<td><?php echo strtoupper($user['nom']); ?></td>
						<td><?php echo strtoupper($user['prenom']); ?></td>
                        <td><?php echo strtoupper($user['email']); ?></td>

						<td>
							<form method="POST" id="statut_<?php echo $cleanEmail?>">
							
							<select name="statut_<?php echo $cleanEmail?>">
								<option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>user</option>
								<option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>admin</option>
								<option value="banni" <?php echo $user['role'] == 'ban' ? 'selected' : ''; ?>>ban</option>
							</select>
						
						</td>
					
						<td>    
                            <button type="button" name="statut_submit_<?php echo $cleanEmail; ?>" class="champ" onclick="statutModif('<?php echo $cleanEmail; ?>');">OK</button>
                        </td>

							</form>
					</tr>
				<?php
				}
				?>
				

			</tbody>
		</table>
        
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
