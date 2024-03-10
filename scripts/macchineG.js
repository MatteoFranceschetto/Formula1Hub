function loadMacchineContent() {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var newsContent = xhr.responseText;

            // Inserisci il codice della notizia nel div main_container
            document.getElementById('main_container').innerHTML = newsContent;
        }
    };

    xhr.open('POST', '../query/loadStoricoM', true);
    xhr.send();
}

document.addEventListener("DOMContentLoaded", loadMacchineContent());