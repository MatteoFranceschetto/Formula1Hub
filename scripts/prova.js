function redirect(url) {
    // Specifica l'URL della tua pagina PHP
    var phpPageURL = url;

    // Crea un elemento di modulo dinamico
    var form = document.createElement('form');
    form.method = 'post';
    form.action =  phpPageURL;

    // Aggiungi il modulo alla pagina
    document.body.appendChild(form);

    // Invia automaticamente il modulo
    form.submit();
}
