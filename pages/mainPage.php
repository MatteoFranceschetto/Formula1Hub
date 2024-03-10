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


        <style>
            
            .slideshow-container , .img{
                max-width: 1000px;
                max-height: 500px;
                min-width: 500px;
                min-height: 250px;
                position: relative;
                margin: auto;
            }


        </style>

        
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
        <div id="errorMessage"></div>               <!-- Display messaggi di errore -->

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
            <section class="hero-section">
                <div class="hero-content">
                    <h1>Benvenuto su Formula1Hub!</h1>
                    <p>Il centro nervoso dell'adrenalina automobilistica.</p>


                    <div class="slideshow-container" style="margin-top: 6.5%;">
                    <div class="mySlides fade">
                    
                    <img src="../img/macchine/ferrari.png" style="width:100%" class="img">

                    </div>

                    <div class="mySlides fade">
                    
                    <img src="../img/piloti/hamilton.png" style="width:100%" class="img">

                    </div>

                    <div class="mySlides fade">
                    
                    <img src="../img/piloti/leclerc.png" style="width:100%" class="img">

                    </div>

                    </div>
                    <br>

                    <div style="text-align:center">
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    <span class="dot"></span> 
                    </div>

                    <script>
                        var slideIndex = 0;
                        showSlides();
                        
                        function showSlides() {
                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        var dots = document.getElementsByClassName("dot");
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";  
                        }
                        slideIndex++;
                        if (slideIndex > slides.length) {slideIndex = 1}    
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideIndex-1].style.display = "block";  
                        dots[slideIndex-1].className += " active";
                        setTimeout(showSlides, 5000); // Change image every 2 seconds
                        }
                    </script>


                    
                </div>
            </section>

            <section class="about-section">
                <div class="container">
                    <h2>Chi siamo</h2>
                    <p>Formula1Hub è il tuo punto di riferimento per tutte le ultime notizie, aggiornamenti e analisi approfondite sulla Formula 1. Da anni siamo al centro del mondo emozionante della Formula 1, fornendo ai nostri lettori informazioni accurate e dettagliate.</p>
                    
                    <p>La passione per la Formula 1 è ciò che ci guida. Siamo una squadra di esperti appassionati che vive e respira il motorsport ad ogni gara, con un unico obiettivo: portare ai nostri lettori il meglio di questo straordinario sport.</p>

                    <p>Copriamo ogni aspetto della Formula 1, dagli avvincenti Gran Premi ai dettagli tecnici dei bolidi, dalle storie dei piloti alle strategie delle scuderie. Con la nostra dedizione e competenza, ci impegniamo a offrire un'esperienza informativa completa per tutti gli appassionati.</p>

                    <p>Oltre alle ultime notizie e aggiornamenti in tempo reale, offriamo analisi approfondite delle gare, interviste esclusive, e un'ampia copertura dei test invernali e delle sessioni di prove libere. Sia che tu sia un fan incallito o un osservatore occasionale, troverai su Formula1Hub un luogo dove approfondire la tua passione per la Formula 1.</p>
                </div>
            </section>

            <section class="services-section">
                <div class="container">
                    <h2>I nostri servizi</h2>
                    <div class="service">
                        <h3>Risultati e Classifiche</h3>
                        <p>Scopri i risultati delle gare passate e le classifiche aggiornate dei piloti e dei team. Dai un'occhiata ai tempi dei giri, alle posizioni in classifica e alle statistiche dettagliate per avere una visione completa della stagione di Formula 1.</p>
                    </div>
                    <div class="service">
                        <h3>Analisi Approfondite</h3>
                        <p>Approfondimenti e commenti degli esperti per comprendere meglio il mondo della Formula 1. Le nostre analisi vanno oltre i risultati, esplorando le tattiche di gara, le scelte dei pneumatici, le strategie dei team e molto altro. Se vuoi capire cosa sta davvero accadendo dietro le quinte, sei nel posto giusto.</p>
                    </div>
                    <div class="service">
                        <h3>News</h3>
                        <p>Ogni giorno, nuovi articoli su gare, squadre e piloti. Siamo costantemente aggiornati con le ultime notizie della Formula 1, fornendo ai nostri lettori un flusso continuo di informazioni fresche e interessanti. Che tu stia cercando dettagli sui prossimi eventi, interviste esclusive o retroscena sulle squadre, troverai tutto qui.</p>
                    </div>
                </div>
            </section>

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