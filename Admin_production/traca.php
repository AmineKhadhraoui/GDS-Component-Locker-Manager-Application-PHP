<?php
// Établir une connexion à la base de données SQL Server
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = "";
$dbname = "CLM";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//make your connection here
//	*************************
//
/*$connectionOptions = [
    "Database" => $databaseName,
    "Uid" => $uid,
    "PWD" => $pass,
    "TrustServerCertificate" => true
];

// Establish connection to the database
$connect = sqlsrv_connect($serverName, $connectionOptions);
*/
// Initialiser les variables à afficher
$message = "";
$messageClass = ""; // Contiendra la classe Bootstrap
$isDisabled = ""; // Contiendra l'attribut "disabled"

// Vérifier si le formulaire a été soumis
if (isset($_POST['codice'])) {
    // Récupérer la valeur saisie par l'utilisateur
    $valeurRecherchee = $_POST['codice'];

    // Échapper les caractères spéciaux pour éviter les injections SQL (optionnel, mais recommandé)

    // Effectuer la requête SQL pour vérifier si la valeur existe dans la table
    $sql1 = "SELECT idNiAnagrafica, LabelCode, ManufactureDate, Qty, ItemCode
             from  nigraphica
            WHERE ItemCode = '$valeurRecherchee'";
    $result1 = $conn->query( $sql1);

    // Vérifier si la requête a retourné des résultats
    if ($result1 && $result1->num_rows > 0) {
        // La valeur existe dans la table
        $message = "La valeur existe dans la table.";
        $messageClass = "success"; // Classe Bootstrap pour succès
        $isDisabled = ""; // Activer les autres champs
    } else {
        // La valeur n'existe pas dans la table
        $message = "La valeur n'existe pas dans la table.";
        $messageClass = "danger"; // Classe Bootstrap pour danger
        $isDisabled = "disabled"; // Désactiver les autres champs
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>