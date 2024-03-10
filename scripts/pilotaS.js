function loadPilotaSContent() {
    var pilot = document.getElementById('hiddenField').value;

    // Chiamata AJAX per ottenere il contenuto della notizia da loadNews.php
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var newsContent = xhr.responseText;

            // Inserisci il codice della notizia nel div container_pilota
            document.getElementById('container_pilota').innerHTML = newsContent;
        }
    };

    xhr.open('POST', '../query/loadPilotaS.php', true);
    xhr.send("pilota=" + pilot);
}

document.addEventListener("DOMContentLoaded", loadPilotaSContent());