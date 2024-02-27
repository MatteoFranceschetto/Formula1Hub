// ---------------- barra del menu laterale ---------------------------------------

function toggleSidebar() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeSidebar() {
    document.getElementById("mySidenav").style.width = "0";
}

// ---------------- Menu utente dropdown -----------------------------------------

function toggleDropdown() {
    var dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.classList.toggle("active");

    // Mostra/nascondi il menu a tendina
    dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
}

// Chiudi il menu a tendina se si fa clic ovunque nella pagina
window.addEventListener("click", function(event) {
    var dropdownMenu = document.getElementById("dropdownMenu");
    var profileIcon = document.querySelector(".profilo");

    if (!event.target.matches(".profilo") && !event.target.matches(".avatar") && !event.target.closest(".dropdown-menu")) {
        // Chiudi il menu a tendina se si fa clic fuori da esso o sull'icona del profilo
        dropdownMenu.style.display = "none";
    }
});

// ---------------- Chiamata controllo login ---------------------------------------

function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    /*var xhr = new XMLHttpRequest();
    xhr.open("POST", "../query/Utenti_login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText.includes("Login riuscito")) {
                // Estrai il nome e il cognome dalla risposta
                var matches = xhr.responseText.match(/Benvenuto, (\w+) (\w+)/);
                var nome = matches[1];
                var cognome = matches[2];

                // Aggiorna il menu a tendina con l'avatar personalizzato e il nome/cognome
                updateDropdown(nome, cognome);
            } 
        }
    };
    xhr.send("username=" + username + "&password=" + password);
*/

updateAvatar("Lorenzo", "Senesi");
    closeLogin();
}

function openLogin() {
    // Mostra il login e l'overlay
    document.getElementById("overlay").style.display = "block";
    document.getElementById("loginContainer").style.display = "block";
}

function closeLogin() {
    // Chiudi il login e l'overlay
    document.getElementById("overlay").style.display = "none";
    document.getElementById("loginContainer").style.display = "none";

    // Resetta i campi di input
    document.getElementById("username").value = "";
    document.getElementById("password").value = "";
}

document.addEventListener("DOMContentLoaded", function() {
    const overlay = document.getElementById("overlay");
    const loginContainer = document.getElementById("loginContainer");

    // Aggiungi un listener per chiudere il login se si clicca fuori dal contenitore
    overlay.addEventListener("click", closeLogin);
});

// ---------------- Chiamata controllo registrazione ---------------------------------------

function register() {
    var nome = document.getElementById("nome").value;
    var cognome = document.getElementById("cognome").value;
    var regUsername = document.getElementById("regUsername").value;
    var regPassword = document.getElementById("regPassword").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../query/Utenti_register.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText); // Puoi gestire la risposta come desideri
        }
    };
    xhr.send("nome=" + nome + "&cognome=" + cognome + "&username=" + regUsername + "&password=" + regPassword);

    closeRegister();
}

document.addEventListener("DOMContentLoaded", function() {
    const overlay = document.getElementById("overlay");
    const loginContainer = document.getElementById("loginContainer");
    const registerContainer = document.getElementById("registerContainer");

    // Aggiungi un listener per chiudere la registrazione se si clicca fuori dal contenitore
    overlay.addEventListener("click", closeRegister);
});

function openRegister() {
    // Mostra la registrazione e l'overlay
    document.getElementById("overlay").style.display = "block";
    document.getElementById("registerContainer").style.display = "block";
}

function closeRegister() {
    // Chiudi la registrazione e l'overlay
    document.getElementById("overlay").style.display = "none";
    document.getElementById("registerContainer").style.display = "none";

    // Resetta i campi di input
    document.getElementById("nome").value = "";
    document.getElementById("cognome").value = "";
    document.getElementById("regUsername").value = "";
    document.getElementById("regPassword").value = "";
}

// ---------------- Funzioni Comuni ---------------------------------------

function updateAvatar(nome, cognome) {
    // Seleziona l'elemento avatar esistente
    var avatar = document.querySelector(".avatar_Custom");
    document.getElementById("default_img").style.display = "none";

    // Crea o aggiorna l'avatar personalizzato con iniziali e colore casuale
    if (!avatar) {
        avatar = document.createElement("div");
        avatar.className = "avatar_Custom";
        avatar.style.float = "right";
        document.getElementById("profilo").appendChild(avatar);
    }

    // Rimuovi l'immagine
    avatar.innerHTML = "";

    // Aggiungi il cerchio con iniziali e sfondo colorato
    var inizialiContainer = document.createElement("div");
    inizialiContainer.className = "iniziali-container";
    inizialiContainer.style.backgroundColor = getRandomColor();

    var iniziali = document.createElement("span");
    iniziali.textContent = nome.charAt(0) + cognome.charAt(0);

    inizialiContainer.appendChild(iniziali);
    avatar.appendChild(inizialiContainer);

    // Crea o aggiorna il blocco per il nome e cognome accanto al nuovo avatar
    var infoContainer = document.querySelector(".info-container");
    if (!infoContainer) {
        infoContainer = document.createElement("div");
        infoContainer.className = "info-container";
        document.getElementById("profilo").appendChild(infoContainer);
    }

    var nomeCognomeSpan = document.createElement("span");
    nomeCognomeSpan.textContent = nome + " " + cognome;
    infoContainer.innerHTML = ""; // Pulisci il contenuto attuale
    infoContainer.appendChild(nomeCognomeSpan);

    // Puoi mantenere il link "Profilo" immutato
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}