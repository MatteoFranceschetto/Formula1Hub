// Funzione di reindirizzamento
function redirectToPHPPage() {
    // Specifica l'URL della tua pagina PHP
    var phpPageURL = "pages/mainPage.php";

    // Crea un elemento di modulo dinamico
    var form = document.createElement('form');
    form.method = 'post';
    form.action =  phpPageURL;

    // Aggiungi il modulo alla pagina
    document.body.appendChild(form);

    // Invia automaticamente il modulo
    form.submit();
}

// Aggiungi un listener per il caricamento della pagina
document.addEventListener("DOMContentLoaded", function() {
    // Chiama la funzione di reindirizzamento
    redirectToPHPPage();
});