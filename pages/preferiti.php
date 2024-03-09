<!DOCTYPE html>
<html>
    <?php session_start(); ?>
    <head>
        <title>Formula1Hub - Il Centro Nervoso dell'Adrenalina Automobilistica</title>
        <meta name="description" content="Formula 1 Hub: il tuo centro di notizie sulla Formula 1. Aggiornamenti in tempo reale, risultati, e analisi approfondite. Segui le gare e rimani al passo con il mondo emozionante della Formula 1!">
        <meta name="keywords" content="Formula 1 Hub">

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=9">
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="../css/base_style.css">
        <script src="../scripts/base_script.js"></script>

    </head>

    <body>
    
        <header id="myHeader">
            <div class="menu-icon" onclick="toggleSidebar()">
                <div class="menu-lines"></div>
                <div class="menu-lines"></div>
                <div class="menu-lines"></div>
            </div>

            <div class="centro">
                <p><img src="../img/Logo.png" class="logo"> FORMULA 1 HUB</p>
            </div>

            <div class="profilo" id="profilo" onclick="toggleDropdown()">
                <img src="../img/guest_ico.png" alt="profile" class="avatar" id="default_img" style="">

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

            <!-- Aggiungi la checkbox "Rimani Connesso" -->
            <label id="rememberMe">Rimani Connesso <input type="checkbox" id="rememberMe_Login" name="rememberMe_Login"></label>

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

            <!-- Aggiungi la checkbox "Rimani Connesso" -->
            <label id="rememberMe">Rimani Connesso <input type="checkbox" id="rememberMe_Register" name="rememberMe_Register"></label>

            <button onclick="register()">Registrati</button>
            <span onclick="closeRegister()" class="close-btn">&times;</span>
        </div>

        <main>            
            <h1>PRFERITI</h1>
            <h3>squadra</h3>
            <p>se c'è la squadra preferita</p>
            <img src="../img/loghi/ferrari.png" alt="ferrari"> <!--logo della squadra peferita-->

            <p>foto piloti preferiti</p>
            <img src="../img/piloti/leclerc.png" alt="leclerc"> <!--pilota della squadra peferita-->
            <img src="../img/piloti/leclerc.png" alt="leclerc"> <!--pilota della squadra peferita-->

            <p>leggi le notizie della tua squadra</p>
            <div>
                <h3>How drivers stay healthy during the season</h3>
                <p>At the 2023 Abu Dhabi Grand Prix, after claiming his second top-three finish of the season, <br> George Russell, looking visibly weary, walked onto the podium above....</p>
            </div>

            <div>
                <h3>How drivers stay healthy during the season</h3>
                <p>At the 2023 Abu Dhabi Grand Prix, after claiming his second top-three finish of the season, <br> George Russell, looking visibly weary, walked onto the podium above....</p>
            </div>

            <div>
                <h3>How drivers stay healthy during the season</h3>
                <p>At the 2023 Abu Dhabi Grand Prix, after claiming his second top-three finish of the season, <br> George Russell, looking visibly weary, walked onto the podium above....</p>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            se non c'è 

            <input type="button" value="scegli la tua squadra preferita: " onclick=" "> <!--facciamo compatire qualcosa dove chiede di inserire la squadra preferita-->

            <select name="sceltasquadra" id="sceltasquadra"> <!--questo va dentro la roba che compare-->
                <option value="squadra1">squadra1</option>
                <option value="squadra2">squadra2</option>
                <option value="squadra3">squadra3</option>
                <option value="squadra4">squadra4</option>
                <option value="squadra5">squadra5</option>
            </select>

 
        </div>
               
        </main>

        <footer>
        <div class="footer-container">
        <div class="footer-section">
            <h3>Ultime Notizie</h3>
            <ul>
                <li><a href="#">Campionato Attuale</a></li>
                <li><a href="#">Gare e Risultati</a></li>
                <li><a href="#">Team e Piloti</a></li>
                <li><a href="#">Classifiche</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Contatti</h3>
            <p>Formula 1 News</p>
            <p>Indirizzo: Via del Circuito, 123</p>
            <p>Email: info@formula1news.com</p>
        </div>

        <div class="footer-section">
            <h3>Seguici</h3>
            <ul class="social-icons">
                <li><a href="#" target="_blank"><img src="../img/facebook.png" alt="Facebook"></a></li>
                <li><a href="#" target="_blank"><img src="../img/x.png" alt="X"></a></li>
                <li><a href="#" target="_blank"><img src="../img/Instagram.png" alt="Instagram"></a></li>
            </ul>
        </div>
    </div>

    <div class="copyright">
        <p>&copy; 2024 Formula 1 News. Tutti i diritti riservati.</p>
    </div>
        </footer>

    </body>

</html>