<?php
// Inclure le fichier de configuration de la base de données
require 'db_config.php';

// Vérifier si le terme de recherche est fourni
if (isset($_GET['query'])) {
    // Récupérer le terme de recherche depuis la requête GET
    $searchTerm = $_GET['query'];

    // Préparer la requête SQL pour rechercher les jeux par titre
    $query = "SELECT * FROM JEUX WHERE NOM_JEUX LIKE :searchTerm";
    $stmt = $db->prepare($query);

    $searchTerm = "$searchTerm%";
    $stmt->bindParam(':searchTerm', $searchTerm);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Récupérer les résultats de la recherche
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Renvoyer les résultats au format JSON
        echo json_encode($searchResults);
    } else {
        // Gérer l'erreur si la requête échoue
        echo json_encode([]);
    }
} else {
    // Gérer l'erreur si aucun terme de recherche n'est fourni
    echo json_encode([]);
}

// Vérifier l'inactivité de la session
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 180) {
    // Détruire la session et rediriger vers la page de connexion
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    // Mettre à jour le timestamp de la dernière activité
    $_SESSION['last_activity'] = time();
}
?>
