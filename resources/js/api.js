//start API
function stampa(){
  $.ajax({
	  url: '/api/visitors',
	  method:'POST',
	  headers: {
		  'Authorization': 'Bearer Pippo123'
	  },
	  success:function(data){
          var dati = data.data;
		  console.log(dati);
	  },
	  error: function(){
	  // alert('errore');
	  }
  });
};

//end API
