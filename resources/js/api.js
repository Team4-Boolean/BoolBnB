//start API

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

//end API
