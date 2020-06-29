// handlebars
const Handlebars = require("handlebars");

//handlebars card template
if (document.getElementById("card-template-search")) {
    var source = $("#card-template-search").html();
    var cardTemplate = Handlebars.compile(source);
}

    //end handlebars


//Start API

// se l'url ha un determinato path fai partire l'ajax
var search = $(location).attr('search');

var searchParams1 = new URLSearchParams(search);
var lat = searchParams1.get("lat");
var log = searchParams1.get("log");
var radius = searchParams1.get("radius");


$('#tasto').keypress(function(event){
    if (event.keyCode == 13) { //---------> CON TASTO ENTER <--------
        searches();
    };
});

$('#tasto').click(function () {
   searches();
});

var slider = document.getElementById("myRange");
$("#myRange").on("input", function(e) {
  searches();
});


 function stampa(lat,log,radius){
     $.ajax({
         url: '/api/houses/' + lat  + '/' + log + '/' + radius ,
         method:'GET',
         headers: {
             'Authorization': 'Bearer TEST1234'
         },
         success:function(data){
            console.log(data);
            var results = data.data;
            var cardPosition = '#js-cards';
            appendCard(results,cardPosition);
             // var search = $(location).attr('search');
             // var searchParams = new URLSearchParams(search);
             // searchParams.set("log", log);
             // searchParams.set("lat", lat);
         },
         error: function(){
         // alert('errore');
         }
     });
 };

 function appendCard(arrays,position) {
    for (var i = 0; i < arrays.length; i++) {
        var array = arrays[i];
        var object = {title:array.title, id: array.id,photo:array.photo,description:array.description,beds:array.beds,rooms:array.rooms};
        var filledTemplate = cardTemplate(object);
        $(position).append(filledTemplate);
    };
};

function searches() {
    $('#js-cards').children().remove(); // reset search
    var searchBData = $('#address').val();
    console.log(searchBData);
    if (searchBData.length !== 0) {
        houseSearch()
    } else {
        alert('Write something');
    };
};


function houseSearch() {
    var log = $("#longitude").val();
    var lat = $("#latitude").val();
    var radius = $("#myRange").val();
    console.log(radius);
    stampa(lat,log,radius);
};

    //End API
