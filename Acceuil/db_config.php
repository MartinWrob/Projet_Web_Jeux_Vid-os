<?php
$host = 'localhost'; // Hôte de la base de données
$dbname = 'projet_jeux_video'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur de la base de données
$password = ''; // Mot de passe de la base de données

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    // Afficher un message d'erreur en HTML
    echo "<p>Erreur de connexion à la base de données : " . $e->getMessage() . "</p>";
    exit;
}
?>
