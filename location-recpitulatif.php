<?php
session_start();

$i= isset($_GET['i']) ? (int) $_GET['i'] : 0;

if(!isset($_SESSION['user'])){
	header("Location: connexion.php");
}

?>
<!DOCTYPE html>
<html lang="fr"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location de Voiture - Résumé de Réservation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo $_SESSION['voyages'][$i]['titre']; ?></h1>
			<h1><?php echo $_SESSION['voyages'][$i]['lieux']; ?></h1>
            <p>Veuillez vérifier les détails de votre location de voiture ci-dessous</p>
        </header>

        <?php
        // Dans une application réelle, ces données proviendraient d'un formulaire,
        // d'une base de données ou de variables de session
		$nom = $_SESSION['user']['nom'];
		$prenom = $_SESSION['user']['prenom'];
		$prix = $_SESSION['voyages'][$i]['prix'];
		$duree = $_SESSION['voyages'][$i]['duree'];
		
        $rentalInfo = [
            'customer_name' => 'Jean Dupont',
            'car_model' => 'Toyota Camry',
            'car_class' => 'Berline Intermédiaire',
            'pickup_date' => '2024-01-15',
            'return_date' => '2024-01-20',
            'pickup_location' => 'Aéroport International de Paris',
            'return_location' => 'Aéroport International de Paris',
            'daily_rate' => $prix ,
            'insurance' => 'Couverture Complète',
            'insurance_rate' => 15.00,
            'extras' => [
                'GPS Navigation' => 5.99,
                'Siège Enfant' => 7.50
            ]
        ];

        // Calculer la durée de location
        $pickup = new DateTime($rentalInfo['pickup_date']);
        $return = new DateTime($rentalInfo['return_date']);
        $days = $pickup->diff($return)->days;

        // Calculer les coûts
        $rental_cost = $prix * $days;
        $insurance_cost = $rentalInfo['insurance_rate'] * $days;
        $extras_cost = array_sum($rentalInfo['extras']);
        $subtotal = $rental_cost + $insurance_cost + $extras_cost;
        $tax = $subtotal * 0.20; // TVA à 20%
        $total = $subtotal + $tax;
        ?>

        <div class="summary-card">
            <div class="summary-section">
                <h2>Informations du Véhicule</h2>
                <div class="summary-item">
                    <span class="label">Modèle de Voiture:</span>
                    <span class="value"><?php echo htmlspecialchars($rentalInfo['car_model']); ?></span>
                </div>
                <div class="summary-item">
                    <span class="label">Catégorie:</span>
                    <span class="value"><?php echo htmlspecialchars($rentalInfo['car_class']); ?></span>
                </div>
            </div>

            <div class="summary-section">
                <h2>Détails de la Location</h2>
                <div class="summary-item">
                    <span class="label">Date de Prise en Charge:</span>
                    <span class="value"><?php echo date('j F Y', strtotime($rentalInfo['pickup_date'])); ?></span>
                </div>
                <div class="summary-item">
                    <span class="label">Date de Retour:</span>
                    <span class="value"><?php echo date('j F Y', strtotime($rentalInfo['return_date'])); ?></span>
                </div>
                <div class="summary-item">
                    <span class="label">Durée:</span>
                    <span class="value"><?php echo $_SESSION['voyages'][$i]['duree']; ?> jours</span>
                </div>
                <div class="summary-item">
                    <span class="label">Lieu de Prise en Charge:</span>
                    <span class="value"><?php echo htmlspecialchars($rentalInfo['pickup_location']); ?></span>
                </div>
                <div class="summary-item">
                    <span class="label">Lieu de Retour:</span>
                    <span class="value"><?php echo htmlspecialchars($rentalInfo['return_location']); ?></span>
                </div>
            </div>

            <div class="summary-section">
                <h2>Détail des Coûts</h2>
                <div class="summary-item">
                    <span class="label">Tarif Journalier:</span>
                    <span class="value"><?php echo $prix; ?> $</span>
                </div>
                <div class="summary-item">
                    <span class="label">Coût de Location (<?php echo $days; ?> jours):</span>
                    <span class="value"><?php echo number_format($rental_cost, 2, ',', ' '); ?> $</span>
                </div>
                <div class="summary-item">
                    <span class="label">Assurance (<?php echo htmlspecialchars($rentalInfo['insurance']); ?>):</span>
                    <span class="value"><?php echo number_format($insurance_cost, 2, ',', ' '); ?> $</span>
                </div>
                
                <?php if (!empty($rentalInfo['extras'])): ?>
                    <div class="summary-item extras-header">
                        <span class="label">Options Supplémentaires:</span>
                        <span class="value"></span>
                    </div>
                    <?php foreach ($rentalInfo['extras'] as $extra => $price): ?>
                    <div class="summary-item extra-item">
                        <span class="label"><?php echo htmlspecialchars($extra); ?>:</span>
                        <span class="value"><?php echo number_format($price, 2, ',', ' '); ?> $</span>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="summary-item subtotal">
                    <span class="label">Sous-total:</span>
                    <span class="value"><?php echo number_format($subtotal, 2, ',', ' '); ?> $</span>
                </div>
                <div class="summary-item">
                    <span class="label">TVA (20%):</span>
                    <span class="value"><?php echo number_format($tax, 2, ',', ' '); ?> $</span>
                </div>
                <div class="summary-item total">
                    <span class="label">Total:</span>
                    <span class="value"><?php echo number_format($total, 2, ',', ' '); ?> $</span>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="reservations.php?i=<?php echo $i; ?>" class="btn btn-secondary">Modifier la Réservation</a>
			<?php
			require('getapikey.php');

			$transaction= '123456789ABCDEF';
			$montant= $prix;
			$vendeur= 'MI-1_B';
			
			$retour= 'http://'.$_SERVER['SERVER_NAME'].'/projetcliqcy/main.php';

			$api_key=getAPIKey($vendeur);

			$control=md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$retour."#");

			
		?>
		<form action="https://www.plateforme-smc.fr/cybank/" method="POST">
		<input type="hidden" name="transaction" value="<?php echo($transaction); ?>">
		<input type="hidden" name="montant" value="<?php echo($montant); ?>">
		<input type="hidden" name="vendeur" value="<?php echo($vendeur); ?>">
		<input type="hidden" name="retour" value="<?php echo ($retour); ?>">
		<input type="hidden" name="control" value="<?php echo ($control); ?>">
		<input type="submit" class="btn btn-primary" value="Confirmer la Réservation">
		</form>
        </div>
    </div>
</body>
</html>
