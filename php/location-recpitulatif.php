<?php
session_start(); 

$i= isset($_GET['i']) ? (int) $_GET['i'] : 0;

if(!isset($_SESSION['user'])){
	header("Location: connexion.php");
    exit();
}

$voyageId = $_SESSION['voyages'][$i]['id'];
$titre = $_SESSION['voyages'][$i]['titre'];
$lieux = $_SESSION['voyages'][$i]['lieux'];

$prenom = $_SESSION['user']['prenom'];
$prix = $_SESSION['voyages'][$i]['prix'];
$duree = $_SESSION['voyages'][$i]['duree'];

$debut = date('d-m-Y');
$fin = date('d-m-Y', strtotime("$debut +$duree days"));
   		
$rentalInfo = [
    'id' => $voyageId,
    'title' => $titre,
    'place' => $lieux,

    'car_model' => [
        'Toyota',
        'Renault',
        'Citroen'
    ],
    'car_class' => [
        'Essence',
        'Diesel',
        'Electrique'
    ],
    'lenght' => $duree,
    'pickup_date' => $debut,
    'return_date' => $fin,
    'pickup_location' => [
        'Aéroport de Orly',
        'Aéroport Charles De Gaulles',
    ],
    'return_location' => [
        'Aéroport de Orly',
        'Aéroport Charles De Gaulles',
    ],
    'daily_rate' => $prix ,
    'insurance' => 'Couverture Complete',
    'insurance_rate' => 15.00,

    // options, activités et hébergement pas défaut
    'options' => [
        'GPS Navigation',
        'Siege Enfant',
        'Guide touristique',
    ],
    'activities' => [
        "restauration",
        "musée",
        "safari",
        "randonnée"
    ],
    'accommodation' => [
        "hôtel",
        "camping",
        "chalet",
        "hébergement écoresponsable"
    ],
    'montant' => "1000"
];

$fileOptions = "../data/data_voyages.json";
if(file_exists($fileOptions)){
    $options = json_decode(file_get_contents($fileOptions),true);
    foreach($options as $option){
        if($option['id'] == $voyageId){
            $rentalInfo['options'] = $option['options'];
        }
    }
}

$fileEtapes = "../data/data_etapes.json";
if(file_exists($fileEtapes)){
    $etapes = json_decode(file_get_contents($fileEtapes),true);
    foreach($etapes as $etape){
        if($etape['id'] == $voyageId){
            $rentalInfo['activities'] = $etape['activite'];
            $rentalInfo['accommodation'] = $etape['hebergement'];
        }
    }
}

$rental_cost = $prix * $duree;
$insurance_cost = $rentalInfo['insurance_rate'] * $duree;
$extras_cost = count($_POST['options'] ?? []) * 10;
$subtotal = $rental_cost + $insurance_cost + $extras_cost;
$tax = $subtotal * 0.20; // TVA à 20%
$total = $subtotal + $tax;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$_SESSION['paiement']['id'] = $voyageId;
	$_SESSION['paiement']['title'] = $titre; 
	$_SESSION['paiement']['place'] = $lieux;   
    $_SESSION['paiement']['pickup_date'] = $_POST['pickup_date'] ?? date('Y-m-d');
    $_SESSION['paiement']['return_date'] = date('Y-m-d', strtotime($_SESSION['paiement']['pickup_date']. "+$duree days"));
    $_SESSION['paiement']['lenght'] = $duree;
    $_SESSION['paiement']['car_model'] = $_POST['car_model'];
    $_SESSION['paiement']['car_class'] = $_POST['car_class'];
    $_SESSION['paiement']['pickup_location'] = $_POST['pickup_location'];
    $_SESSION['paiement']['return_location'] = $_POST['return_location'];
    $_SESSION['paiement']['options'] = isset($_POST['options']) ? $_POST['options'] : [];
    $_SESSION['paiement']['activities'] = isset($_POST['activities']) ? $_POST['activities'] : [];
    $_SESSION['paiement']['accommodation'] = isset($_POST['accommodation']) ? [$_POST['accommodation']] : [];
    $_SESSION['paiement']['montant'] = $total;

}else{

	$_SESSION['paiement']['id'] = $voyageId;
	$_SESSION['paiement']['title'] = $titre; 
	$_SESSION['paiement']['place'] = $lieux; 
	$_SESSION['paiement']['pickup_date'] = $debut;
    $_SESSION['paiement']['return_date'] = $fin;
    $_SESSION['paiement']['lenght'] = $duree;
    $_SESSION['paiement']['car_model'] = 0;
    $_SESSION['paiement']['car_class'] = 0;
    $_SESSION['paiement']['pickup_location'] = 0;
    $_SESSION['paiement']['return_location'] = 0;
    $_SESSION['paiement']['options'] = [];
    $_SESSION['paiement']['activities'] = [];
    $_SESSION['paiement']['accommodation'] = [];
    $_SESSION['paiement']['montant'] = 0;

}

	if(isset($_POST['retour_accueil'])){
		header("Location: main.php");
		exit();
	}
?>

<html> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Location de Voiture - Résumé de Réservation</title>
        <link rel="icon" type="image/x-icon" href="../img/logo.png">
        <link
        href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Calistoga&family=Didact+Gothic&family=Funnel+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="../css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/fonctionnel.js"></script>
   	 	<script type="text/javascript" src="../js/visual.js"></script>
    </head>
<body class="location">
    <div class="container_location">
        <div class="header_location">
            <h1 style="color: black"><?php echo $titre; ?></h1>
			<h1 style="color: black"><?php echo $lieux; ?></h1>
            <p>Veuillez vérifier les détails de votre location de voiture ci-dessous</p>
        </div>

        <form method="POST" action="location-recpitulatif.php?i=<?php echo $i;?>">

        <div class="resume-card">
            <h2 style="padding:15px 10px 0px 20px"> Modifier les Informations de Réservation :</h2>
            <p style="color:red; font-size:15px; padding:15px"> N'oubliez pas d'enregistrer les modifications avant de valider ! </p>
            
            <div class="resume-section">
                <h2>Informations du Véhicule</h2>
                <div class="resume-item">
                    <span class="label">Modèle de Voiture:</span>
                    <select style="margin-left: 600px;" name="car_model">
                        <option value="Toyota" <?php echo $_SESSION['paiement']['car_model'] == 'Toyota' ? 'selected' : ''; ?>>Toyota</option>
                        <option value="Renault" <?php echo $_SESSION['paiement']['car_model'] == 'Renault' ? 'selected' : ''; ?>>Renault</option>
                        <option value="Citroen" <?php echo $_SESSION['paiement']['car_model'] == 'Citroen' ? 'selected' : ''; ?>>Citroen</option>
                    </select></br>
                </div>
                <div class="resume-item">
                    <span class="label">Catégorie:</span>
                    <select style="margin-left: 650px;" name="car_class">
                        <option value="Essence" <?php echo $_SESSION['paiement']['car_class'] == 'Essence' ? 'selected' : ''; ?>>Essence</option>
                        <option value="Diesel" <?php echo $_SESSION['paiement']['car_class'] == 'Diesel' ? 'selected' : ''; ?>>Diesel</option>
                        <option value="Electrique" <?php echo $_SESSION['paiement']['car_class'] == 'Electrique' ? 'selected' : ''; ?>>Electrique</option>
                    </select></br>
                </div>
            </div>

            <div class="resume-section">
                <h2>Détails de la Location</h2>
                <div class="resume-item">
                    <span class="label">Date de Prise en Charge:</span>
                    <input id="depart" style="margin-left: 500px;" type="date" name="pickup_date" onchange="Dretour(<?php echo $_SESSION['paiement']['lenght'] ?>);" value="<?php echo $_SESSION['paiement']['pickup_date']; ?>" required><br><br>
                </div>
                <div class="resume-item">
                    <span class="label">Date de Retour:</span>
                    <span class="value" id="retour"><?php echo date('j F Y', strtotime($_SESSION['paiement']['return_date'])); ?></span>
                </div>
                <div class="resume-item">
                    <span class="label">Durée:</span>
                    <span class="value"><?php echo $_SESSION['paiement']['lenght']; ?> jours</span>
                </div>
                <div class="resume-item">
                    <span class="label">Lieu de Prise en Charge:</span>
                    <select style="margin-left: 435px;" name="pickup_location">
                        <option value="Aéroport de Orly" <?php echo $_SESSION['paiement']['pickup_location'] == 'Aéroport de Orly' ? 'selected' : ''; ?>>Aéroport de Orly</option>
                        <option value="Aéroport Charles De Gaulles" <?php echo $_SESSION['paiement']['pickup_location'] == 'Aéroport Charles De Gaulles' ? 'selected' : ''; ?>>Aéroport Charles De Gaulles</option>
                    </select></br>
                </div>
                <div class="resume-item">
                    <span class="label">Lieu de Retour:</span>
                    <select style="margin-left: 500px;" name="return_location">
                        <option value="Aéroport de Orly" <?php echo $_SESSION['paiement']['return_location'] == 'Aéroport de Orly' ? 'selected' : ''; ?>>Aeroport de Orly</option>
                        <option value="Aéroport Charles De Gaulles" <?php echo $_SESSION['paiement']['return_location'] == 'Aéroport Charles De Gaulles' ? 'selected' : ''; ?>>Aeroport Charles De Gaulles</option>
                    </select></br>
                </div>
            </div>

            <div class="resume-section">
                <h2>Détail des Coûts</h2>
                <div class="resume-item">
                    <span class="label">Tarif Journalier:</span>
                    <span class="value"><?php echo $prix; ?> $</span>
                </div>
                <div class="resume-item">
                    <span class="label">Coût de Location (<?php echo $duree; ?> jours):</span>
                    <span class="value"><?php echo number_format($rental_cost, 2, ',', ' '); ?> $</span>
                </div>
                <div class="resume-item">
                    <span class="label">Assurance (<?php echo $rentalInfo['insurance']; ?>):</span>
                    <span class="value"><?php echo number_format($insurance_cost, 2, ',', ' '); ?> $</span>
                </div>

                <span class="label">Activités :</span><br>
                <?php foreach ($rentalInfo['activities'] as $activity): ?>
                    <input type="checkbox" onclick="prix_reservation(<?php echo $subtotal ?>, <?php echo $rentalInfo['lenght']; ?>, <?php echo $prix; ?>)" name="activities[]" value="<?php echo $activity; ?>"
                    <?php echo (!empty($_POST['activities']) && in_array($activity, $_POST['activities'])) ? 'checked' : ''; ?>>
                    <?php echo $activity; ?><br>
                <?php endforeach; ?>
                <br>

                <span class="label">Hébergement :</span><br>
                <?php foreach ($rentalInfo['accommodation'] as $place): ?>
                 <input type="radio" onclick="prix_reservation(<?php echo $subtotal ?>, <?php echo $rentalInfo['lenght']; ?>, <?php echo $prix; ?>)" name="accommodation" value="<?php echo $place; ?>"  
                <?php echo (isset($_POST['accommodation']) ? ($_POST['accommodation'] == $place) : (isset($rentalInfo['accommodation'][0]) && $rentalInfo['accommodation'][0] == $place)) ? 'checked' : ''; ?> required>   
                <?php echo $place; ?><br>
                <?php endforeach; ?>
                <br>

                <?php if (!empty($rentalInfo['options'])): ?>
                    <span class="label">Options supplémentaires (+10$ par option):</span><br>
                    <?php foreach ($rentalInfo['options'] as $extra): ?>
                    <input type="checkbox" onclick="prix_reservation(<?php echo $subtotal ?>, <?php echo $rentalInfo['lenght']; ?>, <?php echo $prix; ?>)" name="options[]" value="<?php echo $extra; ?>"
                    <?php echo (!empty($_POST['options']) && in_array($extra, $_POST['options'])) ? 'checked' : ''; ?>>
                    <?php echo $extra; ?><br>
                <?php endforeach; ?>
                <?php endif; ?>

                
                <div class="resume-item subtotal">
                    <span class="label">Sous-total:</span>
                    <span id="ssttl" class="value"><?php echo number_format($subtotal, 2, ',', ' '); ?> $</span>
                </div>
                <div class="resume-item">
                    <span class="label">TVA (20%):</span>
                    <span id="tva" class="value"><?php echo number_format($tax, 2, ',', ' '); ?> $</span>
                </div>
                <div class="resume-item total">
                    <span class="label">Total:</span>
                    <span id="ttl" class="value"><?php echo number_format($total, 2, ',', ' '); ?> $</span>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <input class="btn btn-primary" type="submit" value="Mettre à jour la réservation">
            <input class="btn btn-primary" type="submit" name="retour_accueil" value="Retour Accueil">
			<?php
			require('getapikey.php');

			$transaction = '123456789ABCDEF';
			$montant = $total;
			$vendeur = 'MI-1_B';
			$titre  = $_SESSION['voyages'][$i]['titre'];
            $retour = "http://localhost:1234/php/detailsPaiement.php";

			$api_key = getAPIKey($vendeur);

			$control = md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$retour."#");
		?>

        </form>

		<form action="https://www.plateforme-smc.fr/cybank/" method="POST">
		
        	<input type="hidden" name="transaction" value="<?php echo $transaction ; ?>">
		<input type="hidden" name="montant" value="<?php echo $montant; ?>">
		<input type="hidden" name="vendeur" value="<?php echo $vendeur; ?>">
		<input type="hidden" name="retour" value="<?php echo $retour; ?>">
		<input type="hidden" name="control" value="<?php echo $control; ?>">

		<?php 
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    		echo '<input type="submit" class="btn btn-primary" value="Confirmer la Réservation">';
		}
		?>

		</form>

        </div>
    </div>

</body>

</html>
