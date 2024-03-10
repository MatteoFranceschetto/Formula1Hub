function loadNewsContent() {
    var currentIndex = parseInt(document.getElementById('hiddenField').value);

    // Chiamata AJAX per ottenere il contenuto della notizia da loadNews.php
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var newsContent = xhr.responseText;

            // Inserisci il codice della notizia nel div container_news
            document.getElementById('container_news').innerHTML = newsContent;
        }
    };

    xhr.open('POST', '../query/loadNews.php', true);
    var dati = "numero_pagina=" + currentIndex;
    if(document.getElementById('search').value.trim() != "")
        dati += "testo=" + document.getElementById('search').value.trim();
    if(document.getElementById('tiponews').value != "")
        dati += "tipologia=" + document.getElementById('tiponews').value;
    xhr.send(dati);
}

document.addEventListener("DOMContentLoaded", loadNumNews());

function loadNumNews() {
    // Chiamata AJAX per ottenere il numero di notizie da numNews.php
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;

            if (response === 'Nessuna pagina trovata') {
                document.getElementById('container_news').innerText = response;
            } else {
                var numLinksFromPHP = parseInt(response);
                loadNewsContent();
                generateLinks(numLinksFromPHP);
            }
        }
    };

    xhr.open('POST', '../query/numNews.php', true);
    var dati = "";
    if(document.getElementById('search').value.trim() != "")
        dati += "testo=" + document.getElementById('search').value.trim();
    if(document.getElementById('tiponews').value != "")
        dati += "tipologia=" + document.getElementById('tiponews').value;
    xhr.send();
}

function updateHiddenField(value) {
    document.getElementById('hiddenField').value = value;
}

function changeBackground(index) {
    var links = document.getElementsByClassName('circle-link');
    for (var i = 0; i < links.length; i++) {
        links[i].classList.remove('active_links');
    }

    links[index - 1].classList.add('active_links');
}

function generateLinks(numLinks) {
    var navContainer = document.getElementById('nav-container');
    navContainer.innerHTML = '';

    for (var i = 1; i <= numLinks; i++) {
        var link = document.createElement('a');
        link.className = 'circle-link';
        link.textContent = i;

        link.addEventListener('click', function (event) {
            var index = parseInt(event.target.textContent);
            changeBackground(index);
            updateHiddenField(index);
        });

        navContainer.appendChild(link);
    }

    var leftArrow = document.createElement('span');
    leftArrow.innerHTML = '&#9665;'; // Unicode for left arrow
    leftArrow.className = 'arrow';
    leftArrow.addEventListener('click', function () {
        var currentIndex = parseInt(document.getElementById('hiddenField').value);
        var newIndex = (currentIndex - 1 + numLinks) % numLinks;
        changeBackground(newIndex);
        updateHiddenField(newIndex);
    });
    navContainer.appendChild(leftArrow);

    var rightArrow = document.createElement('span');
    rightArrow.innerHTML = '&#9655;'; // Unicode for right arrow
    rightArrow.className = 'arrow';
    rightArrow.addEventListener('click', function () {
        var currentIndex = parseInt(document.getElementById('hiddenField').value);
        var newIndex = (currentIndex + 1) % numLinks;
        changeBackground(newIndex);
        updateHiddenField(newIndex);
    });
    navContainer.appendChild(rightArrow);
}