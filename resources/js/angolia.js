// Start Angolia search

var places = require('places.js');
if (document.getElementById("address")) {
    var placesAutocomplete = places({
      appId: 'plHITMYHF3UE',
      apiKey: '61a6ce694b1ac511d9482961428abdf1',
      container: document.querySelector('#address'),
    })

    placesAutocomplete.on('change', function(e) {
       console.log(e.suggestion);

    });

    console.log(placesAutocomplete);

    placesAutocomplete.on('change', function resultSelected(e) {
     document.querySelector('#latitude').value = e.suggestion.latlng.lat || '';
     document.querySelector('#longitude').value = e.suggestion.latlng.lng || '';
    });

    // End Angolia search


    // Start Angolia map

    if (document.getElementById("map-example-container")) {
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
    }

}

  // End Angolia map
