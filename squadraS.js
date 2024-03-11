function loadSquadraSContent() {
    var scuderia = document.getElementById('hiddenField').value;

    // Chiamata AJAX per ottenere il contenuto della notizia da loadNews.php
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var newsContent = xhr.responseText;

            // Inserisci il codice della notizia nel div container_scuderia
            document.getElementById('container_scuderia').innerHTML = newsContent;
        }
    };

    xhr.open('POST', '../query/loadScuderiaS.php', true);
    xhr.send("scuderia=" + scuderia);
}

document.addEventListener("DOMContentLoaded", loadSquadraSContent());