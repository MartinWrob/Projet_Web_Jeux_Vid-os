<?php
require 'SignUpModel.php';
require 'db_config.php'; 

class UserController {
    private $db; 

    public function __construct($db) {
        $this->db = $db;
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Vérification des mots de passe correspondants
            $confirm_password = $_POST['confirm_password'];
            
            if ($password !== $confirm_password) {
                echo "Les mots de passe ne correspondent pas.";
                return; // arrête l'exécution de la fonction
            }

            if (!empty($lastname) && !empty($firstname) && !empty($email) && !empty($password)) {
                $userModel = new UserModel($this->db); 
                $name = $lastname . " " . $firstname;
                $userModel->addUser($lastname, $firstname, $email, $password);
                header("Location: SignUp_success.php");
                exit();
            } else {
                echo "Tous les champs doivent être remplis.";
            }
        }
    }
}

?>
