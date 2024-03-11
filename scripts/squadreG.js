document.addEventListener("DOMContentLoaded", caricaDatiPiloti);

function caricaDatiPiloti() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../query/loadSquadreG.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("Accept", "text/html");  // Imposta l'intestazione Accept su "text/html"
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.getElementById('piloti-tabella').innerHTML = xhr.responseText;
            } else {
                alert("Qualcosa è andato storto");
            }
        }
    };

    xhr.send();
}