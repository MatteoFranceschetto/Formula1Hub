//#region SideNav
// ---------------- barra del menu laterale ---------------------------------------

function toggleSidebar() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeSidebar() {
    document.getElementById("mySidenav").style.width = "0";
}
//#endregion

//#region Menu a tendina
// ---------------- Menu utente dropdown -----------------------------------------

function toggleDropdown(event) {

    var dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.classList.toggle("active");

    // Mostra/nascondi il menu a tendina
    dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
}

// Chiudi il menu a tendina se si fa clic ovunque nella pagina
window.addEventListener("click", function(event) {
    var dropdownMenu = document.getElementById("dropdownMenu");
    var profileIcon = document.getElementById("profilo");
    var avatarCustom = document.querySelector(".avatar_Custom");
    var inizialiContainer = document.querySelector(".avatar_Custom .iniziali-container");

    if (
        !profileIcon.contains(event.target) &&
        !event.target.closest(".dropdown-menu") &&
        !event.target.closest(".info-container") 
    ) {
        // Chiudi il menu a tendina se si fa clic fuori da esso, sull'icona del profilo o su avatar_Custom
        dropdownMenu.style.display = "none";
    }
});
//#endregion

//#region Chiamata controllo login
// ---------------- Chiamata controllo login ---------------------------------------

function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var xhr = new XMLHttpRequest();
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
                updateAvatar(nome, cognome);
                updateDropdown();
                updateSidenav();
                creaSessione(nome,cognome);

                if(document.getElementById("rememberMe_Login").checked = true){
                    creaCookie("nome", nome, 30); // durata 30 giorni
                    creaCookie("cognome", cognome, 30);
                }

                console.log(document.cookie);
                console.log(sessionStorage.getItem("utenteConnesso"));
            }
        }
    };
    xhr.send("username=" + username + "&password=" + password);

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
    document.getElementById("rememberMe_Login").checked = false;
}

document.addEventListener("DOMContentLoaded", function() {
    const overlay = document.getElementById("overlay");
    const loginContainer = document.getElementById("loginContainer");

    // Aggiungi un listener per chiudere il login se si clicca fuori dal contenitore
    overlay.addEventListener("click", closeLogin);
});

//#endregion

//#region Chiamata controllo registrazione
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
            if(xhr.responseText.includes("Registrazione completata con successo")){
                // Aggiorna il menu a tendina con l'avatar personalizzato e il nome/cognome
                updateAvatar(nome, cognome);
                updateDropdown();
                updateSidenav();
                creaSessione(nome, cognome);

                if(document.getElementById("rememberMe_Register").checked = true){
                    creaCookie("nome", nome, 30); // durata 30 giorni
                    creaCookie("cognome", cognome, 30);
                }
            }
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
    document.getElementById("rememberMe_Register").checked = false;
}
//#endregion

//#region Chiamata LogOut
//----------------- Chiamata Funzione di LogOut ---------------------------

function logOut() {
    // Chiudi la sessione
    chiudiSessione();

    // Esegui le funzioni inverse
    ripristinaAvatarDefault();
    ripristinaDropdown();
    ripristinaSideNav();
}

function chiudiSessione() {
    // Rimuovi i dati della sessione da sessionStorage
    sessionStorage.removeItem("utenteConnesso");
}

function ripristinaAvatarDefault() {
    // Ripristina l'avatar predefinito
    var avatar = document.querySelector(".avatar_Custom");
    var nome_cognome = document.querySelector(".info-container");
    document.getElementById("default_img").style.display = "block";
    
    avatar.parentNode.removeChild(avatar);
    nome_cognome.parentNode.removeChild(nome_cognome);
    
}

function ripristinaDropdown() {
    // Ripristina il dropdown
    var dropdown = document.querySelector("#dropdownMenu");

    dropdown.innerHTML = "";

    Login = document.createElement("a");
    Login.textContent = "Login";
    Login.addEventListener("click", openLogin);
    dropdown.appendChild(Login);

    Subscribe = document.createElement("a");
    Subscribe.textContent = "Subscribe";
    Subscribe.addEventListener("click", openRegister);
    dropdown.appendChild(Subscribe);
}

function ripristinaSideNav() {
    // Ripristina il side navigation
    var sidenav = document.querySelector("#mySidenav");

    sidenav.removeChild(document.getElementById("Confronto_line"));
    sidenav.removeChild(document.getElementById("Preferiti_line"));
    sidenav.removeChild(document.getElementById("side_favorite"));
    sidenav.removeChild(document.getElementById("Confronto"));
}
//#endregion

// ---------------- Funzioni Comuni ---------------------------------------

//#region updates
function updateAvatar(nome, cognome) {
    // Seleziona l'elemento avatar esistente
    var avatar = document.querySelector(".avatar_Custom");
    document.getElementById("default_img").style.display = "none";

    // Crea o aggiorna l'avatar personalizzato con iniziali e colore casuale
    if (!avatar) {
        avatar = document.createElement("div");
        avatar.className = "avatar_Custom";
        avatar.style.float = "right";
        avatar.addEventListener("click", toggleDropdown);
        document.getElementById("profilo").appendChild(avatar);
    }

    // Aggiungi il cerchio con iniziali e sfondo colorato
    var inizialiContainer = document.createElement("div");
    inizialiContainer.className = "iniziali-container";
    inizialiContainer.id = "Circle_Background";
    inizialiContainer.style.padding = "10px";
    inizialiContainer.style.borderRadius = "50%";
    inizialiContainer.style.backgroundColor = getRandomColor();

    // Aggiungi un evento click al container delle iniziali
    inizialiContainer.addEventListener("click", toggleDropdown);

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

}

function updateDropdown(){

    var dropdown = document.querySelector("#dropdownMenu");

    dropdown.innerHTML="";

    favorite = document.createElement("a");
    favorite.setAttribute("href", "#");
    favorite.textContent = "Preferiti";
    favorite.id = "menu_favorite";
    dropdown.appendChild(favorite);

    logout = document.createElement("a");
    logout.textContent = "Logout";
    logout.addEventListener("click", logOut);
    logout.id = "logout";
    dropdown.appendChild(logout);

}

function updateSidenav(){   

    var sidenav = document.querySelector("#mySidenav");

    line = document.createElement("hr");
    line.id="Preferiti_line";
    sidenav.appendChild(line);

    favorite = document.createElement("a");
    favorite.setAttribute("href", "#");
    favorite.textContent = "Preferiti";
    favorite.id = "side_favorite";
    sidenav.appendChild(favorite);

    line2 = document.createElement("hr");
    line2.id="Confronto_line";
    sidenav.appendChild(line2);

    contronto = document.createElement("a");
    contronto.setAttribute("href", "#");
    contronto.textContent = "Confronto Piloti";
    contronto.id = "Confronto";
    sidenav.appendChild(contronto);
}
//#endregion

//#region controllo cookie/sessioni remeberMe
//----------------- Controllo cookie/sessioni remeberMe ----------------------------

function controllaCookieUtente() {
    // Leggi i cookie per nome e cognome
    var nome = leggiCookie("nome");
    var cognome = leggiCookie("cognome");

    if (nome && cognome) {
        // I cookie sono presenti, crea una sessione
        creaSessione(nome, cognome);

        // Chiama le funzioni di aggiornamento
        updateAvatar(nome, cognome);
        updateDropdown();
        updateSidenav();

        console.log("Utente connesso:", nome, cognome);
    } else {
        controllaSessione();
        console.log("Nessun cookie utente trovato.");
    }
}

function creaSessione(nome, cognome) {
    // Memorizza i dati della sessione in sessionStorage
    sessionStorage.setItem("utenteConnesso", JSON.stringify({ nome: nome, cognome: cognome }));
}

function controllaSessione() {
    // Controlla se esiste una sessione
    var sessione = sessionStorage.getItem("utenteConnesso");

    if (sessione) {
        // Sessione presente, ottieni i dati e chiama le funzioni di aggiornamento
        var utente = JSON.parse(sessione);
        updateAvatar(utente.nome, utente.cognome);
        updateDropdown();
        updateSidenav();

        console.log("Utente connesso dalla sessione:", utente.nome, utente.cognome);
    } else {
        console.log("Nessuna sessione utente trovata.");
    }
}

// Funzione ausiliaria per leggere il valore di un cookie dato il nome
function leggiCookie(nomeCookie) {
    var nomeCookieEQ = nomeCookie + "=";
    var cookieArray = document.cookie.split(';');
    
    for (var i = 0; i < cookieArray.length; i++) {
        var cookie = cookieArray[i].trim();
        
        if (cookie.indexOf(nomeCookieEQ) === 0) {
            return cookie.substring(nomeCookieEQ.length, cookie.length);
        }
    }
    
    return null;
}

function creaCookie(nome, valore, giorniScadenza) {
    var dataScadenza = new Date();
    dataScadenza.setTime(dataScadenza.getTime() + (giorniScadenza * 24 * 60 * 60 * 1000));
    var scadenza = "expires=" + dataScadenza.toUTCString();
    document.cookie = nome + "=" + valore + ";" + scadenza + ";path=/";
}

window.addEventListener("load", function() {
    // Stampa i cookie
    console.log("Cookies:");
    console.log(document.cookie);

    // Stampa le sessioni in sessionStorage
    console.log("Session Storage:");
    for (var i = 0; i < sessionStorage.length; i++) {
        var key = sessionStorage.key(i);
        var value = sessionStorage.getItem(key);
        console.log(key + ": " + value);
    }
});

window.onload = function() {
    // Chiamata a controllaCookieUtente() dopo che tutti gli script sono stati caricati
    controllaCookieUtente();
};
//#endregion

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}