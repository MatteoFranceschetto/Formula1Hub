function redirectPilota(codice) {
    // Specifica l'URL della tua pagina PHP
    var phpPageURL = "pilota_spec.php";

    // Crea un elemento di modulo dinamico
    var form = document.createElement('form');
    form.method = 'post';
    form.action =  phpPageURL;

    // Aggiungi il modulo alla pagina
    document.body.appendChild(form);

    // Invia automaticamente il modulo
    form.submit();
}


function redirectSquadra(nome) {
    // Specifica l'URL della tua pagina PHP
    var phpPageURL = "squadra_spec.php";

    // Crea un elemento di modulo dinamico
    var form = document.createElement('form');
    form.method = 'post';
    form.action =  phpPageURL;

    // Aggiungi il modulo alla pagina
    document.body.appendChild(form);

    // Invia automaticamente il modulo
    form.submit();
}

