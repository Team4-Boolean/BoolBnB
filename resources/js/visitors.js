var visitors = $('.container-visitors-js').data('visitors');

var meseVisitatore = {
    'gennaio': 0,
    'febbraio': 0,
    'marzo': 0,
    'aprile': 0,
    'maggio': 0,
    'giugno': 0,
    'luglio': 0,
    'agosto': 0,
    'settembre': 0,
    'ottobre': 0,
    'novembre': 0,
    'dicembre': 0
}; //Prendo i mesi per poi popolarli in base alla data

for (var i = 0; i < visitors.length; i++) {
    var visitor = visitors[i];
    var valore = visitor.house_id; //Trovo gli id riferiti a quella casa
    var mese = visitor.created_at.substring(0,10); // Trovo le date (solo le prime 10 cifre)
    var thisMonth = moment(mese, 'YYYY/MM/DD').format("MMMM"); //Trovo solo i MESI dalle date, estrapolo da mese (YYYY/MM/DD), solo i nomi dei mesi .format('MMMM')

    meseVisitatore[thisMonth] += $(valore).length; //Per ogni mese faccio il conto di quante visite ha ricevuto la mia casa
}
valoriFinali(meseVisitatore) //--------> Porto fuori la mia variabile per ciclare 'for in ' mesi e visitatori <---------

//Funzione per trovare  i valori finali
function valoriFinali(meseVisitatore){
    var labelsChart = []; // Creazione variabile vuota per inserirci le mie date da richiamare poi nella chart
    var dataChart = []; // Creazione variabile vuota per inserirci i miei visitatori da richiamare poi nella chart

    for (var key in meseVisitatore) {
        labelsChart.push(key);
        dataChart.push(meseVisitatore[key]);
    }
    laMiaSomma(labelsChart, dataChart);
};

//Assegno i valori finali trovati, alla mia CHART per i valori mensili
function laMiaSomma(labels, data){
    var ctx = $('#grafico-visitors');
    var chart = new Chart(ctx, {

        type: 'line',

        data: {
            labels: labels, //riporto il mio valore del mese
            datasets: [{
                label: 'Visite annunci',
                backgroundColor: '#ff5a5f',
                borderColor: '#ee3055',
                data: data //riporto il totale dei miei vistatori
            }]
        },
    });
};
