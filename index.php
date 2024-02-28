<!DOCTYPE html>
<html>

    <head>
        <title>Formula1Hub - Il Centro Nervoso dell'Adrenalina Automobilistica</title>
        <meta name="description" content="Formula 1 Hub: il tuo centro di notizie sulla Formula 1. Aggiornamenti in tempo reale, risultati, e analisi approfondite. Segui le gare e rimani al passo con il mondo emozionante della Formula 1!">
        <meta name="keywords" content="Formula 1 Hub">

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
                <p><img src="img/Logo.png" class="logo"> FORMULA 1 HUB</p>
            </div>

            <div class="profilo" id="profilo" onclick="toggleDropdown()">
                <img src="img/guest_ico.png" alt="profile" class="avatar" id="default_img" style="">

                <div class="dropdown-menu" id="dropdownMenu" style="display:none;">
                    <!-- Contenuto del menu a tendina -->
                    <a onclick="openLogin()">Login</a>
                    <a onclick="openRegister()">Subscribe</a>
                </div>
            </div>
        </header>
       
        <div id="mySidenav" class="sidenav">        <!-- Side Menu -->
            <a class="closebtn" onclick="closeSidebar()">&times;</a>
            <a href="#">About</a>
            <hr>
            <a href="#">Services</a>
            <hr>
            <a href="#">Clients</a>
            <hr>
            <a href="#">Contact</a>
        </div>

        <div id="overlay"></div>                    <!-- Display di Login e Register -->

        <div class="login-container" id="loginContainer">
            <h2>Login</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button onclick="login()">Login</button>
            <span onclick="closeLogin()" class="close-btn">&times;</span>
        </div>
               

        <div class="register-container" id="registerContainer">
            <h2>Registrazione</h2>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>
            <label for="username">Username:</label>
            <input type="text" id="regUsername" name="regUsername" required>
            <label for="password">Password:</label>
            <input type="password" id="regPassword" name="regPassword" required>
            <button onclick="register()">Registrati</button>
            <span onclick="closeRegister()" class="close-btn">&times;</span>
        </div>

        <main>

            <!-- Dove va il testo della pagina -->
            
        </main>

        <footer>
            <!-- Contenuto del footer -->
            <p>&copy; Schievano gay</p>
        </footer>

    </body>

</html>