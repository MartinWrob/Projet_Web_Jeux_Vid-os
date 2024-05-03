<?php
require 'db_config.php';

class GameModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllGames() {
        $query = "
    SELECT 
        j.ID_JEUX,
        j.NOM_JEUX,
        j.DESCRIPTIF_JEUX,
        j.DATE_DE_SORTIE,
        j.LIEN_IMAGE,  
        d.NOM_DEVELOPPEUR,
        g.NOM_GENRE,
        GROUP_CONCAT(p.NOM_PLATEFORME SEPARATOR ', ') AS PLATEFORMES
    FROM
        JEUX j
    INNER JOIN
        DEVELOPPEUR d ON j.ID_DEVELOPPEUR = d.ID_DEVELOPPEUR
    INNER JOIN
        GENRE g ON j.ID_GENRE = g.ID_GENRE
    LEFT JOIN
        EST_DISPONIBLE ed ON j.ID_JEUX = ed.ID_JEUX
    LEFT JOIN
        PLATEFORME p ON ed.ID_PLATEFORME = p.ID_PLATEFORME
    GROUP BY
        j.ID_JEUX;
";

        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
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
$gameModel = new GameModel($db);
$games = $gameModel->getAllGames();

echo json_encode($games);
?>
