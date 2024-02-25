function toggleSidebar() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeSidebar() {
    document.getElementById("mySidenav").style.width = "0";
}



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