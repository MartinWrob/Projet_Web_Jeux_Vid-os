<?php
require 'GameModel.php';

class GameController {
    private $gameModel;

    public function __construct($gameModel) {
        $this->gameModel = $gameModel;
    }

    public function index() {
        $games = $this->gameModel->getAllGames();
        return $games;
    }
}
?>
