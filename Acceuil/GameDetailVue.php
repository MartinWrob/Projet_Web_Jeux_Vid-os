<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du jeu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <img src="Image/Logo_GameHub.png" alt="Logo de la plateforme de jeux vidéo" class="logo">
        <nav>
            <ul>
                
                <li><a href="../../Acceuil/Acceuil.html"><img src="Image/accueil.png" alt="Logo de l'accueil"></a></li>
                <li><a href="Code/Fonctionnalités/Connexion/Connexion.html"><img src="Image/connexion.png" alt="Logo connexion"></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="game-details">
            <h2>Détails du jeu</h2>
            <div class="game-info">
                <img src="<?php echo $gameDetails['LIEN_IMAGE']; ?>" alt="<?php echo $gameDetails['NOM_JEUX']; ?>">
                <h3><?php echo $gameDetails['NOM_JEUX']; ?></h3>
                <p>Genre : <?php echo $gameDetails['NOM_GENRE']; ?></p>
                <p>Développeur : <?php echo $gameDetails['NOM_DEVELOPPEUR']; ?></p>
                <p>Descriptif du jeu : <?php echo $gameDetails['DESCRIPTIF_JEUX']; ?></p>
                <p>Date de sortie : <?php echo $gameDetails['DATE_DE_SORTIE']; ?></p>
                <!-- Ajouter la note et le commentaire ici -->
                <?php if (!empty($gameDetails['NOTE_MOYENNE'])) : ?>
                    <p>Note moyenne : <?php echo $gameDetails['NOTE_MOYENNE']; ?>/5</p>
                <?php endif; ?>
                <p>Commentaire : </p>
                <?php if (!empty($gameDetails['COMMENTAIRES'])) : ?>
                    <div class="comment-container">
                        <?php foreach ($gameDetails['COMMENTAIRES'] as $comment) : ?>
                            <?php $commentParts = explode(' : ', $comment); ?>
                            <p><?php echo $commentParts[0] . ' : ' . $commentParts[1]; ?></p>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Jeux Vidéo. Tous droits réservés.</p>
    </footer>
</body>
</html>
