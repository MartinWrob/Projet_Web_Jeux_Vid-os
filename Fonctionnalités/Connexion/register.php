<?php
require 'db_config.php'; 
require 'SignUpController.php';

$userController = new UserController($db);
$userController->register();
?>
