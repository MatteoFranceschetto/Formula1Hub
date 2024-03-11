function loadNewsContent() {
    if(document.getElementById('hiddenField'))
        var currentIndex = parseInt(document.getElementById('hiddenField').value);
    else
        var currentIndex = 1;

    // Chiamata AJAX per ottenere il contenuto della notizia da loadNews.php
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var newsContent = xhr.responseText;

            // Inserisci il codice della notizia nel div container_news
            document.getElementById('container_news').innerHTML = newsContent;
            loadNumNews();
        }
    };

    xhr.open('POST', '../query/loadNewsG.php', true);
    var dati = "numero_pagina=" + currentIndex;
    var searchElement = document.getElementById('search');
    if (searchElement && searchElement.value.trim() !== "")
        dati += "testo=" + document.getElementById('search').value.trim();
    else{
        dati += "testo=''";
    }
    var tiponews = document.getElementById('tiponews');
    if(tiponews && document.getElementById('tiponews').value != "")
        dati += "tipologia=" + document.getElementById('tiponews').value;
    else{
        dati += "tipologia=''";
    }
    xhr.send(dati);
}

document.addEventListener("DOMContentLoaded", loadNewsContent());

function loadNumNews() {
    // Chiamata AJAX per ottenere il numero di notizie da numNews.php
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../query/numNewsG.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;

            if (response === 'Nessuna pagina trovata') {
                document.getElementById('container_news').innerText = response;
            } else {
                var numLinksFromPHP = parseInt(response);
                generateLinks(numLinksFromPHP);
            }
        }
    };

    var dati = "";
    var searchElement = document.getElementById('search');
    if (searchElement && searchElement.value.trim() !== "")
        dati += "testo=" + document.getElementById('search').value.trim();
    var tiponews = document.getElementById('tiponews');
    if(tiponews && document.getElementById('tiponews').value != "")
        dati += "tipologia=" + document.getElementById('tiponews').value;
    xhr.send(dati);
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