document.addEventListener("load", caricaDatiPiloti());

// Funzione per ottenere e visualizzare i dati dei piloti con Ajax
function caricaDatiPiloti() {
    $.ajax({
        url: '../query/loadSquadre.php', // Sostituisci con il percorso del file PHP che esegue la query del database
        type: 'GET',
        dataType: 'html',
        success: function(data) {
            console.log('Dati ricevuti:', data);
            $('#piloti-tabella').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Errore Ajax: ' + textStatus + ' ' + errorThrown);
            $('#piloti-tabella').html("Errore caricamento pagina");
        }
    });
}