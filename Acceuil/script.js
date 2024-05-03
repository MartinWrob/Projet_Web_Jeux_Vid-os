document.addEventListener('DOMContentLoaded', function() {
    // Écouteur d'événement sur le bouton de connexion
    const connexionLink = document.getElementById('connexionLink');
    connexionLink.addEventListener('click', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du lien
        
        // Effectuer une requête AJAX pour vérifier si l'utilisateur est connecté
        fetch('check_session.php')
            .then(response => response.json())
            .then(data => {
                // Vérifier la réponse
                if (data.utilisateurConnecte) {
                    // Si l'utilisateur est connecté, rediriger vers la page de profil
                    window.location.href = '../Fonctionnalités/Connexion/show.php';
                } else {
                    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
                    window.location.href = '../Fonctionnalités/Connexion/Connexion.html';
                }
            })
            .catch(error => {
                // Gérer les erreurs de requête AJAX
                console.error('Erreur lors de la vérification de la session :', error);
            });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Sélection de l'élément contenant les filtres
    const filtersContainer = document.getElementById('filters-container');

    // Sélection de la barre de recherche
    const searchBar = document.querySelector('input[type="text"]');

    // Écouter l'événement focus sur la barre de recherche
    searchBar.addEventListener('focus', function() {
        // Ajouter la classe 'active' pour afficher les filtres
        filtersContainer.classList.add('active');
    });

    // Écouter l'événement blur sur la barre de recherche
    searchBar.addEventListener('blur', function() {
        // Ne rien faire si les filtres sont déjà actifs
        if (!filtersContainer.classList.contains('active')) {
            // Ajouter la classe 'active' pour afficher les filtres
            filtersContainer.classList.add('active');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Variables globales pour la pagination
    let currentPage = 1;
    const gamesPerPage = 3; // Nombre de jeux par page

    // Fonction pour charger les jeux vidéo depuis le serveur
    function loadGamesFromServer(url) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const gamesData = JSON.parse(xhr.responseText);
                displayGamesWithPagination(gamesData);
            } else if (xhr.readyState === 4 && xhr.status !== 200) {
                console.error('Erreur lors de la récupération des jeux vidéo : ' + xhr.status);
            }
        };
        xhr.send();
    }

    // Fonction pour afficher les jeux vidéo d'une page spécifique
    function displayGamesPage(gamesData, page) {
        const gamesContainer = document.getElementById('games-container');
        let gamesHTML = '';
        const startIndex = (page - 1) * gamesPerPage;
        const endIndex = startIndex + gamesPerPage;
        const displayedGames = gamesData.slice(startIndex, endIndex);
        displayedGames.forEach(function(game) {
            gamesHTML += `
                <div class="game">
                    <div class="buttons">
                        <button class="review-game-btn" data-game-id="${game.ID_JEUX}"><img src="Image/avis.png" alt="Logo avis"></button>
                    </div>
                    <img src="${game.LIEN_IMAGE}" alt="${game.NOM_JEUX}" data-game-id="${game.ID_JEUX}">
                    <h3>${game.NOM_JEUX}</h3>
                </div>
            `;
        });
        gamesContainer.innerHTML = gamesHTML;

        // Ajouter un gestionnaire d'événements au conteneur des jeux pour gérer les clics sur les images
gamesContainer.addEventListener('click', function(event) {
    const target = event.target;
    if (target.tagName === 'IMG') {
        const gameId = target.getAttribute('data-game-id');
        if (gameId) {
            window.location.href = 'DetailJeu.php?id=' + gameId;
        }
    }
});

// Ajouter un gestionnaire d'événements pour les boutons d'avis
const reviewButtons = document.querySelectorAll('.review-game-btn');
reviewButtons.forEach(button => {
    button.addEventListener('click', function() {
        const gameId = this.getAttribute('data-game-id');
        window.location.href = `../Fonctionnalités/Avis/Avis_Commentaire.html?gameId=${gameId}`;
    });
});
    }

    // Fonction pour afficher les jeux vidéo avec pagination
    function displayGamesWithPagination(gamesData) {
        const totalGames = gamesData.length;
        const totalPages = Math.ceil(totalGames / gamesPerPage);

        // Vérifier si la page actuelle est valide
        if (currentPage < 1) {
            currentPage = 1;
        } else if (currentPage > totalPages) {
            currentPage = totalPages;
        }

        // Afficher les jeux de la page actuelle
        displayGamesPage(gamesData, currentPage);

        // Ajouter les boutons de pagination
        const paginationContainer = document.getElementById('pagination-container');
        let paginationHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            paginationHTML += `<button class="pagination-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }
        paginationContainer.innerHTML = paginationHTML;

        // Gérer le clic sur les boutons de pagination
        const paginationButtons = document.querySelectorAll('.pagination-btn');
        paginationButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Mettre à jour la classe .active pour les boutons de pagination
                paginationButtons.forEach(btn => btn.classList.remove('active')); // Supprimer la classe active de tous les boutons
                this.classList.add('active'); // Ajouter la classe active au bouton cliqué

                currentPage = parseInt(this.getAttribute('data-page'));
                displayGamesPage(gamesData, currentPage);
            });
        });
    }

    // Écouter le clic sur le bouton "Découvrir les jeux"
    const discoverGamesBtn = document.querySelector('.btn');
    discoverGamesBtn.addEventListener('click', function(event) {
        event.preventDefault();
        loadGamesFromServer('GameModel.php');
    });

    // Fonction pour effectuer la recherche
    function searchGames(query) {
        const url = `SearchModel.php?query=${query}`;
        loadGamesFromServer(url);
    }

    // Écouter les changements dans le champ de recherche
    const searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', function(event) {
        const query = event.target.value;
        searchGames(query);
    });

    // Fonction pour charger les jeux vidéo filtrés depuis le serveur
    function loadFilteredGamesFromServer(developer, platform, genre) {
        const url = `FilterModel.php?developer=${developer}&platform=${platform}&genre=${genre}`;
        loadGamesFromServer(url);
    }

    // Gestionnaire d'événement pour les changements dans les sélecteurs de filtre
    const filterDeveloper = document.getElementById('filter-dev');
    const filterPlatform = document.getElementById('filter-platform');
    const filterGenre = document.getElementById('filter-genre');
    filterDeveloper.addEventListener('change', function() {
        const developer = filterDeveloper.value;
        const platform = filterPlatform.value;
        const genre = filterGenre.value;
        loadFilteredGamesFromServer(developer, platform, genre);
    });
    filterPlatform.addEventListener('change', function() {
        const developer = filterDeveloper.value;
        const platform = filterPlatform.value;
        const genre = filterGenre.value;
        loadFilteredGamesFromServer(developer, platform, genre);
    });
    filterGenre.addEventListener('change', function() {
        const developer = filterDeveloper.value;
        const platform = filterPlatform.value;
        const genre = filterGenre.value;
        loadFilteredGamesFromServer(developer, platform, genre);
    });

    // Charger tous les jeux vidéo au chargement de la page
    loadGamesFromServer('GameModel.php');
});
