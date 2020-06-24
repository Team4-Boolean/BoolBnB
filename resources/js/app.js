require('./bootstrap');

$(document).ready(function () {

    // Porto i miei messaggi dal mio file balde
    var messages = $('.container-messages-show').data('messages');
    mes(messages);

    // AL click mi mostra il corrispettivo messaggio
    function mes(messages) {
        $('.view-message').click(function() {
            // Azzero la schermata del messaggio ricevuto, ad ogni cambio messaggio
            $('.messages-top-id').empty();
            $('.container-left-messages').empty();
            $('.container-right-messages').empty();
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
                    $('.container-left-messages').append('<h5>' + body + '</h5>').css("background-color", "#b3ffb3");
                    $('.messages-top-id').append('<h5>' + 'Messaggio riferito al tuo annuncio id #' + houseId + '</h5>')
                }
            }
        });
    };

    // All'inserimento di un testo nell'input, me lo stampa a schermo cliccando sull'icon (risposta ai messaggi)
    $('.button').click(function() {
        var valueRisp = $('.messages-risp').val();
        $('.messages-risp').val('');
        $('.container-right-messages').append('<h4>' + valueRisp + '</h4>').css("background-color", "#b3ffb3");
    });

    // All'inserimento di un testo nell'input, me lo stampa a schermo premendo invio (keyCode 13)
    $('.messages-risp').keypress(function(event){
        if (event.keyCode == 13) {
            var valueRisp = $('.messages-risp').val();
            $('.messages-risp').val('');
            $('.container-right-messages').append('<h4>' + valueRisp + '</h4>').css("background-color", "#b3ffb3");
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

    //API

    var urlBase = '/api/houses';
    stampa();

  function stampa(){
      $.ajax({
          url: '/api/houses',
          method:'GET',
          headers: {
              'Authorization': 'Bearer TEST1234'
          },
          success:function(data){
              console.log(data);
          },
          error: function(){
          // alert('errore');
          }
      });
  };

    // Angolia

    var places = require('places.js');
    var placesAutocomplete = places({
      appId: 'plHITMYHF3UE',
      apiKey: '61a6ce694b1ac511d9482961428abdf1',
      container: document.querySelector('#address-map'),
   })

   placesAutocomplete.on('change', function(e) {
       console.log(e.suggestion);

 });

   console.log(placesAutocomplete);

   placesAutocomplete.on('change', function resultSelected(e) {
     document.querySelector('#latitude').value = e.suggestion.latlng.lat || '';
     document.querySelector('#longitude').value = e.suggestion.latlng.lng || '';
   });

   // Angolia map

   var map = L.map('map-example-container', {
       scrollWheelZoom: false,
       zoomControl: false
     });

     var osmLayer = new L.TileLayer(
       'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         minZoom: 1,
         maxZoom: 13,
         attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
       }
     );

     var markers = [];

     map.setView(new L.LatLng(0, 0), 1);
     map.addLayer(osmLayer);

     placesAutocomplete.on('suggestions', handleOnSuggestions);
     placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
     placesAutocomplete.on('change', handleOnChange);
     placesAutocomplete.on('clear', handleOnClear);

     function handleOnSuggestions(e) {
       markers.forEach(removeMarker);
       markers = [];

       if (e.suggestions.length === 0) {
         map.setView(new L.LatLng(0, 0), 1);
         return;
       }

       e.suggestions.forEach(addMarker);
       findBestZoom();
     }

     function handleOnChange(e) {
       markers
         .forEach(function(marker, markerIndex) {
           if (markerIndex === e.suggestionIndex) {
             markers = [marker];
             marker.setOpacity(1);
             findBestZoom();
           } else {
             removeMarker(marker);
           }
         });
     }

     function handleOnClear() {
       map.setView(new L.LatLng(0, 0), 1);
       markers.forEach(removeMarker);
     }

     function handleOnCursorchanged(e) {
       markers
         .forEach(function(marker, markerIndex) {
           if (markerIndex === e.suggestionIndex) {
             marker.setOpacity(1);
             marker.setZIndexOffset(1000);
           } else {
             marker.setZIndexOffset(0);
             marker.setOpacity(0.5);
           }
         });
     }

     function addMarker(suggestion) {
       var marker = L.marker(suggestion.latlng, {opacity: .4});
       marker.addTo(map);
       markers.push(marker);
     }

     function removeMarker(marker) {
       map.removeLayer(marker);
     }

     function findBestZoom() {
       var featureGroup = L.featureGroup(markers);
       map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
     }

});
