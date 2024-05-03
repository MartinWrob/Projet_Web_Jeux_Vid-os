<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des jeux vidéo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Liste des jeux vidéo</h1>

    <div id="gamesList">
        <!-- Les jeux vidéo seront affichés ici -->
    </div>

    <script>
        $(document).ready(function() {
            // Charger les données des jeux vidéo en utilisant AJAX
            $.ajax({
                url: 'index.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const gamesList = $('#gamesList');

                    // Parcourir les données et les afficher dynamiquement
                    $.each(data, function(index, game) {
                        const gameElement = `
                            <div>
                                <h2>${game.title}</h2>
                                <img src="${game.image}" alt="${game.title}">
                                <p>${game.description}</p>
                            </div>
                        `;
                        gamesList.append(gameElement);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Une erreur s\'est produite lors du chargement des jeux vidéo.');
                }
            });
        });
    </script>
</body>
</html>
