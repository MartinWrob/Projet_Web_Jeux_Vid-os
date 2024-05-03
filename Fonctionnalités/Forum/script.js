$(document).ready(function(){
    // Fonction pour charger les messages depuis le serveur
    function loadMessages() {
        $.ajax({
            type: 'GET',
            url: 'load_messages.php', 
            success: function(response){
                $('#message-container').html(response); // Afficher les messages dans #message-container
            },
            error: function(xhr, status, error){
                console.error('Erreur lors du chargement des messages:', error);
            }
        });
    }

    // Charger les messages au chargement de la page
    loadMessages();

    $(document).ready(function(){
        $('#message-form').submit(function(e){
            e.preventDefault();
            
            // Récupérer les valeurs des champs
            var title = $('#title').val();
            var content = $('#content').val();
            
            // Envoi des données en AJAX
            $.ajax({
                type: 'POST',
                url: 'ForumController.php', 
                data: {
                    title: title,
                    content: content
                },
                success: function(response){
                    // Traiter la réponse si nécessaire
                    console.log(response);
                    
                    // Recharger les messages après l'envoi du nouveau message
                    loadMessages();
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        });
});
});