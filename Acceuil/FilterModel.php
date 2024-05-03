<?php
require 'db_config.php';

class FilterModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function filterGames($developer, $platform, $genre) {
        // Construire la requête SQL en fonction des paramètres
        $sql = "SELECT
                    JEUX.ID_JEUX,
                    JEUX.NOM_JEUX,
                    JEUX.DESCRIPTIF_JEUX,
                    JEUX.DATE_DE_SORTIE,
                    JEUX.LIEN_IMAGE
                FROM
                    JEUX
                INNER JOIN
                    DEVELOPPEUR ON JEUX.ID_DEVELOPPEUR = DEVELOPPEUR.ID_DEVELOPPEUR
                INNER JOIN
                    GENRE ON JEUX.ID_GENRE = GENRE.ID_GENRE
                INNER JOIN
                    EST_DISPONIBLE ON JEUX.ID_JEUX = EST_DISPONIBLE.ID_JEUX
                INNER JOIN
                    PLATEFORME ON EST_DISPONIBLE.ID_PLATEFORME = PLATEFORME.ID_PLATEFORME";

        // Ajouter des conditions à la requête SQL si des filtres ont été sélectionnés
        $conditions = [];
        $valeurs = [];
        if ($developer !== 'tous') {
            $conditions[] = "DEVELOPPEUR.NOM_DEVELOPPEUR = :developer";
            $valeurs[':developer'] = $developer;
        }
        if ($platform !== 'tous') {
            $conditions[] = "PLATEFORME.NOM_PLATEFORME = :platform";
            $valeurs[':platform'] = $platform;
        }
        if ($genre !== 'tous') {
            $conditions[] = "GENRE.NOM_GENRE = :genre";
            $valeurs[':genre'] = $genre;
        }

        // Ajouter les conditions à la requête SQL si nécessaire
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        // Préparer et exécuter la requête SQL
        $stmt = $this->db->prepare($sql);
        $stmt->execute($valeurs);

        // Renvoyer les résultats de la requête
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

$filterModel = new FilterModel($db);

// Récupérer les valeurs des paramètres de requête GET
$developer = isset($_GET['developer']) ? $_GET['developer'] : 'tous';
$platform = isset($_GET['platform']) ? $_GET['platform'] : 'tous';
$genre = isset($_GET['genre']) ? $_GET['genre'] : 'tous';

// Filtrer les jeux en fonction des paramètres et renvoyer les résultats en JSON
$games = $filterModel->filterGames($developer, $platform, $genre);
header('Content-Type: application/json');
echo json_encode($games);
?>
