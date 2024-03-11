function loadMacchineContent() {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var newsContent = xhr.responseText;

            // Inserisci il codice della notizia nel div container-macchine
            document.getElementById('container-macchine').innerHTML = newsContent;
        }
    };

    xhr.open('POST', '../query/loadStoricoM.php', true);
    xhr.send();
}

document.addEventListener("DOMContentLoaded", loadMacchineContent());