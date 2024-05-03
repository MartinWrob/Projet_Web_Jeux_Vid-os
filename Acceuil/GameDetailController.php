<?php
require_once 'GameDetailModel.php';

class GameDetailController {
    private $gameDetailModel;

    public function __construct($gameDetailModel) {
        $this->gameDetailModel = $gameDetailModel;
    }

    public function index() {
        if (isset($_GET['id'])) {
            $gameId = $_GET['id'];
            $gameDetails = $this->gameDetailModel->getGameDetails($gameId);
            return $gameDetails;
        } else {
            // Gérer l'erreur si l'ID du jeu n'est pas fourni
            echo "ID du jeu non spécifié.";
        }
    }
}

$gameDetailController = new GameDetailController($gameDetailModel);
$gameDetails = $gameDetailController->index();
?>
