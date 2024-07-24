<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linding-product";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
    echo "<br><br>";
} catch (PDOException $e) {
    echo "Connexion échouée: " . $e->getMessage();
    exit(); // Stop further execution if the connection fails
}

?>





<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $livraison = htmlspecialchars($_POST['livraison']);
    $quantity = intval($_POST['quantite']);
    $color = htmlspecialchars($_POST['couleur']);
    $total = $quantity * 199;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            margin-top: 0;
            color: #666;
        }
        .product-info {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .total {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .actions {
            margin-top: 20px;
        }
        .actions button,
        .actions a {
            margin-right: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: green;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
        .actions a {
            border-radius: 50%;
        }
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: whitesmoke;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }
        .h1 {
            color: green;
            text-shadow: 1px 1px 1px black;
            text-align: center;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script>
        function generatePDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Variables PHP récupérées
            const nom = "<?php echo $nom; ?>";
            const email = "<?php echo $email; ?>";
            const phone = "<?php echo $phone; ?>";
            const livraison = "<?php echo $livraison; ?>";
            const quantity = <?php echo $quantity; ?>;
            const color = "<?php echo $color; ?>";
            const total = <?php echo $total; ?>;

            // Styling variables
            const titleColor = '#333';
            const textColor = '#666';
            const lineColor = '#ccc';
            const productTitleFontSize = 12;
            const textFontSize = 10;

            // Header
            doc.setTextColor(titleColor);
            doc.setFontSize(16);
            doc.text("Facture d'achat", 105, 20, null, null, 'center');

            // Client Information
            doc.setFontSize(productTitleFontSize);
            doc.text("Formulaire d'Achat de Produit", 20, 40);
            doc.setTextColor(textColor);
            doc.setFontSize(textFontSize);
            doc.text("Nom complet : " + nom, 20, 50);
            doc.text("Email : " + email, 20, 60);
            doc.text("Phone : " + phone, 20, 70);
            doc.text("Adresse de Livraison : " + livraison, 20, 80);

            // Product Information
            doc.setFontSize(productTitleFontSize);
            doc.text("Samsung Galaxy Watch5 BT (44 mm / Graphite)", 20, 90);
            
            doc.setTextColor(textColor);
            doc.setFontSize(textFontSize);
            doc.text("Quantité : " + quantity, 20, 100);
            doc.text("Couleur : " + color, 20, 110);
            doc.text("Livraison : gratuit", 20, 120);
            doc.text("Prix unitaire : 199 DH", 20, 130);
            doc.text("Total : " + total + " DH", 20, 140);

            // Divider Line
            doc.setDrawColor(lineColor);
            doc.line(20, 150, 190, 150);

            // Total Amount
            doc.setFontSize(14);
            doc.setTextColor(titleColor);
            doc.text("Total à payer : " + total + " DH", 20, 160);

            // Save the PDF
            doc.save("facture.pdf");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="h1">Votre commande a été confirmée avec succès!</h1>
        <p>Merci d'avoir acheté chez nous, votre facture a été générée.</p>
        <h1>Information du client :</h1>
        <div class="product-info">
        <p><strong>nom :</strong> <?php echo $nom; ?></p>
        <p><strong>email :</strong> <?php echo $email; ?></p>
        <p><strong>phone :</strong> <?php echo $phone; ?></p>
        <p><strong>laivraison :</strong> <?php echo $email; ?></p>
        </div>
        <h2>Information du commande :</h2>
        <div class="product-info">
            <p><strong>Produit :</strong> Samsung Galaxy Watch5 BT (44 mm / Graphite)</p>
            <p><strong>Quantité :</strong> <?php echo $quantity; ?></p>
            <p><strong>Couleur :</strong> <?php echo $color; ?></p>
            <p><strong>Prix :</strong> <?php echo $total; ?> DH</p>
            <p><strong>Livraison :</strong> Gratuit</p>
        </div>
        <div class="total">
            Total à payer : <?php echo $total; ?> DH
        </div>
        <div class="actions">
            <button onclick="generatePDF()">Télécharger la facture</button>
            <a href="https://api.whatsapp.com/send?phone=+212640708028" class="float" target="_blank">
                <i class="fa fa-whatsapp my-float"></i>
            </a>
        </div>
    </div>


</body>
</html>

