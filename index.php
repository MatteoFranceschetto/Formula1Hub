<!DOCTYPE html>
<html>

    <head>
        <title>Formula1Hub - Il Centro Nervoso dell'Adrenalina Automobilistica</title>
        <meta name="description" content="Formula1Hub: il tuo centro di notizie sulla Formula 1. Aggiornamenti in tempo reale, risultati, e analisi approfondite. Segui le gare e rimani al passo con il mondo emozionante della Formula 1!">
        <meta name="keywords" content="Formula1Hub">

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="css/base_style.css">
        <script src="scripts/base_script.js"></script>
    </head>

    <body>
    
        <header id="myHeader">
            <div class="menu-icon" onclick="toggleSidebar()">
                <div class="menu-lines"></div>
                <div class="menu-lines"></div>
                <div class="menu-lines"></div>
            </div>

            <div class="centro">
                Testo centrale
            </div>

            <div class="profilo" onclick="toggleDropdown()">
                <img src="img/guest_ico.png" alt="profile" class="avatar">

                <div class="dropdown-menu" id="dropdownMenu">
                    <!-- Contenuto del menu a tendina -->
                    <a href="#">Opzione 1</a>
                    <a href="#">Opzione 2</a>
                    <a href="#">Opzione 3</a>
                </div>
            </div>
        </header>

        <div id="mySidenav" class="sidenav">        <!-- Side Menu -->
            <a class="closebtn" onclick="closeSidebar()">&times;</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>

        <main>

            <!-- Dove va il testo della pagina -->
            
        </main>

        <footer>
            <!-- Contenuto del footer -->
            <p>&copy; 2024 Il tuo sito</p>
        </footer>

    </body>

</html>