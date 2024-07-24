<?php
require 'autoload.php';

// process_order.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate data from the form
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $livraison = filter_input(INPUT_POST, 'livraison', FILTER_SANITIZE_STRING);
    $quantite = filter_input(INPUT_POST, 'quantite', FILTER_VALIDATE_INT);
    $couleur = filter_input(INPUT_POST, 'couleur', FILTER_SANITIZE_STRING);
    
    if (!$email) {
        die("Email invalide.");
    }

    // Define product and price
    $produit = "Samsung Galaxy Watch5 BT (44 mm)";
    $prix = $total; // Replace with the actual price or calculation logic
    
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "linding-product";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("INSERT INTO `order` (nom, email, phone, livraison, produit, quantite, couleur, prix) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiss", $nom, $email, $phone, $livraison, $produit, $quantite, $couleur, $prix);

    if ($stmt->execute()) {
        echo "Commande reçue avec succès !";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    echo "Méthode de requête non valide.";
}
?>
