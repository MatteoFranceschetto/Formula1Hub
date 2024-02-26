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

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../query/Utenti_login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText); // Puoi gestire la risposta come desideri
        }
    };
    xhr.send("username=" + username + "&password=" + password);
}

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
}