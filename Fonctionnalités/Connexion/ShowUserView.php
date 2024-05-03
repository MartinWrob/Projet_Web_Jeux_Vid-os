<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
    <link rel="stylesheet" href="styles_user.css">
</head>
<body>
<header>
        <nav>
            <ul>
                <img src="Image/Logo_GameHub.png" alt="Logo de la plateforme de jeux vidéo">
                <li><a href="#"></a> <img src="Image/accueil.png" alt="Logo de l'accueil"></li>
                <li><a href="#"><img src="Image/jeux.png" alt="Logo jeux vidéos"></a></li>
                <li><a href="#"><img src="Image/discussion.png" alt="Logo forums"></a></li>
                <li><input type="text" id="search-input" placeholder="Rechercher..."></li>
                <li><a href="#" id="connexionLink"><img src="Image/connexion.png" alt="Logo connexion"></a></li>

                
            </ul>
        </nav>
    </header>
    <h1 class="user-info-title">Informations de l'utilisateur :</h1>
    <ul class="user-info">
        <li>Nom : <?php echo $user['NOM_UTILISATEUR']; ?></li>
        <li>Prénom : <?php echo $user['PRENOM_UTILISATEUR']; ?></li>
        <li>Email : <?php echo $user['EMAIL']; ?></li>
        <div>L'ID de l'utilisateur est : <?php echo $userId; ?></div>

    </ul>
</body>
</html>
