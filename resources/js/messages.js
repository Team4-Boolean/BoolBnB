//start messages

    // Porto i miei messaggi dal mio file balde
    var messages = $('.container-messages-show').data('messages');
    mes(messages);

    // AL click mi mostra il corrispettivo messaggio
    function mes(messages) {
        $('.view-message').click(function() {
            // Azzero la schermata del messaggio ricevuto, ad ogni cambio messaggio
            $('.messages-top-id').empty();
            $('.container-left-messages').empty().css("background-color", "rgba(0,0,0,0)");
            $('.container-right-messages').empty().css("background-color", "rgba(0,0,0,0)");
            // Trovo il mio id relativo al messaggio tramite il "data" dal mio file blade
            var bladeMessageId = $(this).data('id');

            // Ciclo i miei messaggi
            for (var i = 0; i < messages.length; i++) {
                var message = messages[i];
                var arrayId = message.id;
                var body = message.body;
                var houseId = message.house_id;

                // Se l'id del file blade corrisponde a quello ciclato, allora lo stampo a schermo
                if (bladeMessageId == arrayId) {
                    $('.container-left-messages').append('<p>' + body + '</p>').css("background-color", "#f2f2f2");
                    $('.messages-top-id').append('<h5>' + 'Messaggio riferito al tuo annuncio ID #' + houseId + '</h5>')
                }
            };
        });
    };

    // All'inserimento di un testo nell'input, me lo stampa a schermo cliccando sull'icon (risposta ai messaggi)
    $('.button').click(function() {
        var valueRisp = $('.messages-risp').val();
        $('.messages-risp').val('');
        $('.container-right-messages').append('<p>' + valueRisp + '</p>').css("background-color", "#f2f2f2");
    });

    // All'inserimento di un testo nell'input, me lo stampa a schermo premendo invio (keyCode 13)
    $('.messages-risp').keypress(function(event){
        if (event.keyCode == 13) {
            var valueRisp = $('.messages-risp').val();
            $('.messages-risp').val('');
            $('.container-right-messages').append('<p>' + valueRisp + '</p>').css("background-color", "#f2f2f2");
        }
    });

    // Only small iphone view
    var small = window.matchMedia("(max-width: 767px)");
        if (small.matches) {
        // Mobile message, alla click sulla visione di un messaggio, cambia schermata
            $('.view-message').click(function() {
                $('.container-messages-index').hide();
                $('.container-messages-show').show();
            });
        }

    // Al click su Message, in versione mobile, se sono dentro la pagina del messaggio da leggere, mi torna alla lista dei messaggi
    $('#mobile-show').click(function (){
        $('.container-messages-index').show();
        $('.container-messages-show').hide();
    });

    //end messages
