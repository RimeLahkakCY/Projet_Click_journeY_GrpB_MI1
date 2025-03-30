<?php
session_start();

$i= isset($_GET['i']) ? (int) $_GET['i'] : 0;

if(!isset($_SESSION['user'])){
	header("Location: connexion.php");
    exit();
}

$prenom = $_SESSION['user']['prenom'];
$prix = $_SESSION['voyages'][$i]['prix'];
$duree = $_SESSION['voyages'][$i]['duree'];

$debut = date('Y-m-d');
$fin = date('Y-m-d', strtotime("$debut +$duree days"));
   		
$rentalInfo = [
    'title' => $_SESSION['voyages'][$i]['titre'],
    'place' => $_SESSION['voyages'][$i]['lieux'],

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
    'options' => [
        'GPS Navigation' => 5.99,
        'Siege Enfant' => 10.99,
        'Guide touristique' => 19.99
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
    ]

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rentalInfo['pickup_date'] = $_POST['pickup_date'] ?? date('Y-m-d');
    $rentalInfo['return_date'] = date('Y-m-d', strtotime("$rentalInfo[pickup_date] +$duree days"));
    $rentalInfo['car_model'] = $_POST['car_model'];
    $rentalInfo['car_class'] = $_POST['car_class'];
    $rentalInfo['pickup_location'] = $_POST['pickup_location'];
    $rentalInfo['return_location'] = $_POST['return_location'];
    $rentalInfo['options'] = isset($_POST['options']) ? $_POST['options'] : [];
    $rentalInfo['activities'] = isset($_POST['activities']) ? $_POST['activities'] : [];
    $rentalInfo['accommodation'] = $_POST['accommodation'] ?? '';

    $dataFile = '../data/data_reservations.json';

    $existe_reserve = false;
    if(file_exists($dataFile)){
        $data = json_decode(file_get_contents($dataFile), true);

        foreach($data as $reservations => $reservation){
            if($reservation['user_id'] == $_SESSION['user']['id']){
                $data[$reservations]['reservation'] = $rentalInfo;
                $existe_reserve = true;
                break;
            }
        }

        if(isset($_POST['retour_accueil'])){
        
            foreach ($data as $key => $reservation) {
                if ($reservation['user_id'] == $_SESSION['user']['id']) {
                    unset($data[$key]); 
                    break;
                }
            }
            file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            header("Location: main.php");
            exit();
        }
    }

    if(!$existe_reserve){
        $New_reservationData = [
            'user_id' => $_SESSION['user']['id'],
            'reservation' => $rentalInfo
        ];
    
        $data[] = $New_reservationData;
    }

    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
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
    </head>
<body class="location">
    <div class="container_location">
        <div class="header_location">
            <h1 style="color: black"><?php echo $_SESSION['voyages'][$i]['titre']; ?></h1>
			<h1 style="color: black"><?php echo $_SESSION['voyages'][$i]['lieux']; ?></h1>
            <p>Veuillez vérifier les détails de votre location de voiture ci-dessous</p>
        </div>

        <?php

        $rental_cost = $prix * $duree;
        $insurance_cost = $rentalInfo['insurance_rate'] * $duree;
        $extras_cost = array_sum($rentalInfo['options']);
        $subtotal = $rental_cost + $insurance_cost + $extras_cost;
        $tax = $subtotal * 0.20; // TVA à 20%
        $total = $subtotal + $tax;
        ?>

        <form method="POST" action="location-recpitulatif.php?i=<?php echo $i;?>">

        <div class="resume-card">
            <h2 style="padding:15px 10px 0px 20px"> Modifier les Informations de Réservation :</h2>
            <p style="color:red; font-size:15px; padding:15px"> N'oubliez pas d'enregistrer les modifications avant de valider ! </p>
            
            <div class="resume-section">
                <h2>Informations du Véhicule</h2>
                <div class="resume-item">
                    <span class="label">Modèle de Voiture:</span>
                    <select name="car_model">
                        <option value="Toyota" <?php echo $rentalInfo['car_model'] == 'Toyota' ? 'selected' : ''; ?>>Toyota</option>
                        <option value="Renault" <?php echo $rentalInfo['car_model'] == 'Renault' ? 'selected' : ''; ?>>Renault</option>
                        <option value="Citroen" <?php echo $rentalInfo['car_model'] == 'Citroen' ? 'selected' : ''; ?>>Citroen</option>
                    </select></br>
                </div>
                <div class="resume-item">
                    <span class="label">Catégorie:</span>
                    <select name="car_class">
                        <option value="Essence" <?php echo $rentalInfo['car_class'] == 'Essence' ? 'selected' : ''; ?>>Essence</option>
                        <option value="Diesel" <?php echo $rentalInfo['car_class'] == 'Diesel' ? 'selected' : ''; ?>>Diesel</option>
                        <option value="Electrique" <?php echo $rentalInfo['car_class'] == 'Electrique' ? 'selected' : ''; ?>>Electrique</option>
                    </select></br>
                </div>
            </div>

            <div class="resume-section">
                <h2>Détails de la Location</h2>
                <div class="resume-item">
                    <span class="label">Date de Prise en Charge:</span>
                    <input type="date" name="pickup_date" value="<?php echo $rentalInfo['pickup_date']; ?>" required><br><br>
                </div>
                <div class="resume-item">
                    <span class="label">Date de Retour:</span>
                    <span class="value"><?php echo date('j F Y', strtotime($rentalInfo['return_date'])); ?></span>
                </div>
                <div class="resume-item">
                    <span class="label">Durée:</span>
                    <span class="value"><?php echo $rentalInfo['lenght']; ?> jours</span>
                </div>
                <div class="resume-item">
                    <span class="label">Lieu de Prise en Charge:</span>
                    <select name="pickup_location">
                        <option value="Aéroport de Orly" <?php echo $rentalInfo['pickup_location'] == 'Aéroport de Orly' ? 'selected' : ''; ?>>Aéroport de Orly</option>
                        <option value="Aéroport Charles De Gaulles" <?php echo $rentalInfo['pickup_location'] == 'Aéroport Charles De Gaulles' ? 'selected' : ''; ?>>Aéroport Charles De Gaulles</option>
                    </select></br>
                </div>
                <div class="resume-item">
                    <span class="label">Lieu de Retour:</span>
                    <select name="return_location">
                        <option value="Aéroport de Orly" <?php echo $rentalInfo['return_location'] == 'Aéroport de Orly' ? 'selected' : ''; ?>>Aeroport de Orly</option>
                        <option value="Aéroport Charles De Gaulles" <?php echo $rentalInfo['return_location'] == 'Aéroport Charles De Gaulles' ? 'selected' : ''; ?>>Aeroport Charles De Gaulles</option>
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
                    <input type="checkbox" name="activities[]" value="<?php echo $activity; ?>"
                    <?php echo (!empty($_POST['activities']) && in_array($activity, $_POST['activities'])) ? 'checked' : ''; ?>>
                    <?php echo $activity; ?><br>
                <?php endforeach; ?>
                <br>

                <span class="label">Hébergement :</span><br>
                <?php foreach ($rentalInfo['accommodation'] as $place): ?>
                    <input type="radio" name="accommodation[]" value="<?php echo $place; ?>"
                    <?php echo (!empty($_POST['accommodation']) && in_array($place, $_POST['accommodation'])) ? 'checked' : ''; ?> required>
                    <?php echo $place; ?><br>
                <?php endforeach; ?>
                <br>

                <?php if (!empty($rentalInfo['options'])): ?>
                    <span class="label">Options supplémentaires :</span><br>
                    <?php foreach ($rentalInfo['options'] as $extra => $price): ?>
                    <input type="checkbox" name="options[<?php echo $extra; ?>]" value="<?php echo $price; ?>"
                    <?php echo (!empty($_POST['options']) && array_key_exists($extra, $_POST['options'])) ? 'checked' : ''; ?>>
                    <?php echo $extra; ?> (<?php echo number_format($price, 2); ?> $)<br>
                <?php endforeach; ?>
                <?php endif; ?>

                
                <div class="resume-item subtotal">
                    <span class="label">Sous-total:</span>
                    <span class="value"><?php echo number_format($subtotal, 2, ',', ' '); ?> $</span>
                </div>
                <div class="resume-item">
                    <span class="label">TVA (20%):</span>
                    <span class="value"><?php echo number_format($tax, 2, ',', ' '); ?> $</span>
                </div>
                <div class="resume-item total">
                    <span class="label">Total:</span>
                    <span class="value"><?php echo number_format($total, 2, ',', ' '); ?> $</span>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <input class="btn btn-primary" type="submit" value="Mettre à jour la réservation">
            <input class="btn btn-primary" type="submit" name="retour_accueil" value="Retour Accueil">
			<?php
			require('getapikey.php');

			$transaction= '123456789ABCDEF';
			$montant= $total;
			$vendeur= 'MI-1_B';
			$titre = $_SESSION['voyages'][$i]['titre'];
			$retour= 'http://localhost:1234/main.php';

			$api_key=getAPIKey($vendeur);

			$control=md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$retour."#");
		?>

        </form>

		<form action="https://www.plateforme-smc.fr/cybank/" method="POST">
		
        <input type="hidden" name="transaction" value="<?php echo $transaction ; ?>">
		<input type="hidden" name="montant" value="<?php echo $montant; ?>">
		<input type="hidden" name="vendeur" value="<?php echo $vendeur; ?>">
		<input type="hidden" name="retour" value="<?php echo $retour; ?>">
		<input type="hidden" name="control" value="<?php echo $control; ?>">
		<input type="submit" class="btn btn-primary" value="Confirmer la Réservation">

		</form>

        </div>
    </div>

</body>

</html>
