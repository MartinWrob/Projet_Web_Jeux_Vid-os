<?php
require_once 'ForumModel.php';

// Appel de la fonction du modèle pour récupérer les messages depuis la base de données
$messages = getMessages(); 

// Boucle pour afficher les messages au format HTML
foreach($messages as $message) {
    // Afficher le message au format demandé
    echo "<div class='message'>";
    echo "<h2>{$message['TITRE_FORUM']} - {$message['DATE_CREATION']}</h2>";
    echo "<p>{$message['NOM_UTILISATEUR']} {$message['PRENOM_UTILISATEUR']} : {$message['CONTENU_FORUM']}</p>";
    echo "</div>";
}
?>
