function loadPilotaSContent() {

    var JSON = getUsername();

    // Chiamata AJAX per ottenere il contenuto della notizia da loadNews.php
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var newsContent = xhr.responseText;

            // Inserisci il codice della notizia nel div container-preferiti
            document.getElementById('container-preferiti').innerHTML = newsContent;
        }
    };

    xhr.open('POST', '../query/loadPreferiti.php', true);
    xhr.send("JSON=" + JSON);
}

document.addEventListener("DOMContentLoaded", loadPilotaSContent());

function getJSON() {
    // Effettua una richiesta AJAX per ottenere l'username dalla sessione
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../query/get_JSON.php', true);
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.status == 200 && xar.readyState == 4) {
            var response = xhr.responseText;
                return response;
        }
    };
    xhr.send();
}