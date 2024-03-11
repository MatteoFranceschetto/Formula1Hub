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
            .container {
                display: flex;
                justify-content: space-around;
            }

            .pilot-selection {
                border: 2px dashed grey;
                padding: 10px;
                margin: 10px;
            }

            .pilot-info {
                text-align: center;
            }

            .pilot-image {
                width: 100px;
                height: 100px;
                cursor: pointer;
            }

            .comparison-result {
                margin-top: 10px;
                font-weight: bold;
            }

            .add-pilot {
                cursor: pointer;
                border: 5px solid #d3d3d3; /* Grigio chiaro */
                min-width: 200px;
                min-height: 300px;
                text-align: center;
                padding: 20px;
            }

            .pilot-selection-list {
                display: none;
                position: absolute;
                top: 100%; /* Posiziona sotto la sezione del pilota principale */
                left: 0;
                background-color: #f9f9f9; /* Colore di sfondo */
                border: 1px solid #d3d3d3; /* Grigio chiaro */
                padding: 10px;
                z-index: 1;
            }

            .pilot-selection-list img {
                width: 50px; /* Adatta la larghezza delle immagini dei piloti */
                height: 50px; /* Adatta l'altezza delle immagini dei piloti */
                cursor: pointer;
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
            <a onclick="redirectToPage('mainPage.php')" style="cursor: pointer;">HOME</a>
            <hr>
            <a onclick="redirectToPage('storiamacchine.php')" style="cursor: pointer;">Macchine</a>
            <hr>
            <a onclick="redirectToPage('generic_squadre.php')" style="cursor: pointer;">Squadre</a>
            <hr>
            <a onclick="redirectToPage('piloti_gen.php')" style="cursor: pointer;">Piloti</a>
            <hr>
            <a onclick="redirectToPage('calendario.php')" style="cursor: pointer;">Calendario</a>
            <hr>
            <a onclick="redirectToPage('generic_news.php')" style="cursor: pointer;">News</a>
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

            <div class="container">
                <div class="pilot-selection" id="selectedPilot1">
                    <!-- Sezione con il "+" iniziale -->
                    <div class="pilot-info" onclick="showPilotSelection()">
                        <div class="add-pilot">
                            <span>+</span>
                            <p>Selezione Pilota</p>
                        </div>
                    </div>
                    <div id="selectedPilotData">
                        <!-- Dati del pilota selezionato verranno visualizzati qui -->
                    </div>
                    <div class="comparison-section">
                        <div class="comparison-result" id="ageComparison"></div>
                        <div class="comparison-result" id="winsComparison"></div>
                    </div>
                </div>

                <div class="pilot-selection-list" id="pilotList">
                    <!-- Lista verticale dei piloti -->
                </div>
            </div>
                    
            <div class="container">
                <div class="pilot-selection" id="selectedPilot2">
                    <!-- Sezione con il "+" iniziale -->
                    <div class="pilot-info" onclick="showPilotSelection()">
                        <div class="add-pilot">
                            <span>+</span>
                            <p>Selezione Pilota</p>
                        </div>
                    </div>
                    <div id="selectedPilotData">
                        <!-- Dati del pilota selezionato verranno visualizzati qui -->
                    </div>
                    <div class="comparison-section">
                        <div class="comparison-result" id="ageComparison"></div>
                        <div class="comparison-result" id="winsComparison"></div>
                    </div>
                </div>

                <div class="pilot-selection-list" id="pilotList">
                    <!-- Lista verticale dei piloti -->
                </div>
            </div>
            
        </main>

        <script>
            function changePilot(pilotId) {
                // Simula una chiamata AJAX per ottenere dati dal server
                // Sostituisci questo con la tua implementazione reale
                const pilotData = getMockPilotData();

                const pilotImage = document.getElementById(`${pilotId}Image`);
                const pilotDataElement = document.getElementById(`${pilotId}Data`);

                // Aggiorna l'immagine del pilota e i dati
                pilotImage.src = pilotData.image;
                pilotDataElement.innerHTML = `
                    <p>Nome: ${pilotData.name}</p>
                    <p>Data di Nascita: ${pilotData.birthDate}</p>
                    <p>Squadra: ${pilotData.team}</p>
                    <p>Numero di Vittorie: ${pilotData.wins}</p>
                    <p>Macchina Guidata: <img src="${pilotData.carImage}" alt="${pilotData.car}" style="width: 50px; height: 50px;"></p>
                `;

                // Esegui i confronti tra i due piloti
                comparePilots();
            }

            function comparePilots() {
                const pilot1Age = getAge(document.getElementById('pilot1Data').querySelector('p[data-type="birthDate"]').innerText);
                const pilot2Age = getAge(document.getElementById('pilot2Data').querySelector('p[data-type="birthDate"]').innerText);

                const pilot1Wins = parseInt(document.getElementById('pilot1Data').querySelector('p[data-type="wins"]').innerText, 10);
                const pilot2Wins = parseInt(document.getElementById('pilot2Data').querySelector('p[data-type="wins"]').innerText, 10);

                // Confronta età e vittorie
                compareAge(pilot1Age, pilot2Age);
                compareWins(pilot1Wins, pilot2Wins);
            }

            function compareAge(pilot1Age, pilot2Age) {
                const resultElement1 = document.getElementById('ageComparison1');
                const resultElement2 = document.getElementById('ageComparison2');

                if (pilot1Age < pilot2Age) {
                    resultElement1.innerText = 'Più giovane';
                    resultElement1.style.color = 'green';
                    resultElement2.innerText = 'Più vecchio';
                    resultElement2.style.color = 'red';
                } else if (pilot1Age > pilot2Age) {
                    resultElement1.innerText = 'Più vecchio';
                    resultElement1.style.color = 'red';
                    resultElement2.innerText = 'Più giovane';
                    resultElement2.style.color = 'green';
                } else {
                    resultElement1.innerText = 'Stessa età';
                    resultElement1.style.color = 'black';
                    resultElement2.innerText = 'Stessa età';
                    resultElement2.style.color = 'black';
                }
            }

            function compareWins(pilot1Wins, pilot2Wins) {
                const resultElement1 = document.getElementById('winsComparison1');
                const resultElement2 = document.getElementById('winsComparison2');

                resultElement1.innerText = `Numero di vittorie: ${pilot1Wins}`;
                resultElement1.style.color = 'black';

                resultElement2.innerText = `Numero di vittorie: ${pilot2Wins}`;
                resultElement2.style.color = 'black';

                if (pilot1Wins < pilot2Wins) {
                    resultElement1.style.color = 'red';
                } else if (pilot1Wins > pilot2Wins) {
                    resultElement2.style.color = 'red';
                }
            }

            function getAge(birthDateString) {
                const birthDate = new Date(birthDateString);
                const currentDate = new Date();
                return currentDate.getFullYear() - birthDate.getFullYear();
            }

            // Funzione di esempio per ottenere dati pilota (da sostituire con la tua implementazione reale)
            function getMockPilotData() {
                return {
                    name: 'Pilota di Esempio',
                    birthDate: '1990-01-01',
                    team: 'Team di Esempio',
                    wins: 15,
                    car: 'Auto di Esempio',
                    carImage: 'link-all-immagine-della-macchina.jpg',
                    image: 'link-all-immagine-del-pilota.jpg',
                };
            }

            // Funzione per mostrare la selezione verticale dei piloti
            function showPilotSelection() {
                const pilotList = document.getElementById('pilotList');
                pilotList.innerHTML = ''; // Pulisce la lista ogni volta che viene aperta

                // Simula una chiamata AJAX per ottenere la lista dei piloti
                // Sostituisci questa chiamata con la tua implementazione reale
                getMockPilotList().forEach(pilot => {
                    const pilotItem = document.createElement('div');
                    pilotItem.className = 'pilot-list-item';
                    pilotItem.innerHTML = `
                        <img src="${pilot.image}" alt="${pilot.name}" onclick="changePilot('selectedPilot', ${JSON.stringify(pilot)})">
                        <p>${pilot.name}</p>
                    `;
                    pilotList.appendChild(pilotItem);
                });

                // Mostra la selezione verticale dei piloti
                pilotList.style.display = 'block';

                // Chiama la funzione per nascondere la lista quando si fa clic altrove
                document.addEventListener('click', closePilotList);
            }

            // Funzione per nascondere la selezione verticale dei piloti quando si fa clic altrove
            function closePilotList(event) {
                const pilotList = document.getElementById('pilotList');
                if (!pilotList.contains(event.target) && event.target.id !== 'selectedPilot') {
                    pilotList.style.display = 'none';
                    document.removeEventListener('click', closePilotList);
                }
            }

            // Funzione per ottenere una lista di piloti (da sostituire con la tua implementazione reale)
            function getMockPilotList() {
                return [
                    {
                        name: 'Pilota 1',
                        image: 'link-all-immagine-pilota-1.jpg'
                    },
                    {
                        name: 'Pilota 2',
                        image: 'link-all-immagine-pilota-2.jpg'
                    },
                    // Aggiungi altri piloti come necessario
                ];
            }
        </script>
        
        <footer>
            <div class="footer-container">
                <div class="footer-section">
                    <h3>Ultime Notizie</h3>
                    <ul>
                        <li><a onclick="redirectToPage('calendario.php')" style="cursor: pointer;">Gare e Risultati</a></li>
                        <li><a onclick="redirectToPage('scuderie.php')" style="cursor: pointer;">Team e Piloti</a></li>
                        <li><a onclick="redirectToPage('classifiche.php')" style="cursor: pointer;">Classifiche</a></li>
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
                        <li><a href="https://www.facebook.com/Formula1" target="_blank" style="cursor: pointer;"><img src="../img/facebook.png" alt="Facebook"></a></li>
                        <li><a href="https://twitter.com/F1" target="_blank" style="cursor: pointer;"><img src="../img/x.png" alt="X"></a></li>
                        <li><a href="https://www.instagram.com/f1/" target="_blank" style="cursor: pointer;"><img src="../img/Instagram.png" alt="Instagram"></a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2024 Formula 1 News. Tutti i diritti riservati.</p>
            </div>
        </footer>

    </body>

</html>