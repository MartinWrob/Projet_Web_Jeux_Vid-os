<?php
// Inclure le contrôleur de détail du jeu
require 'GameDetailController.php';

// Inclure le modèle de détail du jeu
require_once 'GameDetailModel.php';

// Créer une instance du contrôleur de détail du jeu
$gameDetailController = new GameDetailController($gameDetailModel);

session_start();

// Vérifier l'inactivité de la session
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 180) {
    // Détruire la session et rediriger vers la page de connexion
    session_unset();
    session_destroy();
    header("Location: ../Connexion/login.php");
    exit();
} else {
    // Mettre à jour le timestamp de la dernière activité
    $_SESSION['last_activity'] = time();
}


// Vérifier si l'ID du jeu est fourni dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID du jeu depuis l'URL
    $gameId = $_GET['id'];

    // Appeler la méthode du contrôleur pour récupérer les détails du jeu
    $gameDetails = $gameDetailController->index();

    // Vérifier si des détails ont été trouvés pour le jeu
    if ($gameDetails) {
        // Inclure la vue pour afficher les détails du jeu
        require 'GameDetailVue.php';
    } else {
        // Gérer le cas où aucun détail n'est trouvé pour le jeu
        echo "Détails du jeu non trouvés.";
    }
} else {
    // Gérer le cas où l'ID du jeu n'est pas fourni dans l'URL
    echo "ID du jeu non spécifié.";
}

?>
