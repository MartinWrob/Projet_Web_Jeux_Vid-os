$(document).ready(function(){
    $('#review-form').submit(function(e){
        e.preventDefault();
        
        // Récupération de l'ID du jeu depuis l'URL
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var gameId = urlParams.get('gameId');
        
        var formData = $(this).serialize();
        
        // Envoi des données en AJAX
        $.ajax({
            type: 'POST',
            url: 'AvisController.php?gameId=' + gameId, // Utilisation de l'ID dynamique du jeu
            data: formData,
            success: function(response){
                // Traitement de la réponse si nécessaire
                console.log(response);
            }
        });
    });
});
