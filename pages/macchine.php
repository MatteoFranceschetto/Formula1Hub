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

        <link rel="stylesheet" href="../css/base_style.css">
        <script src="../scripts/base_script.js"></script>

        <<style>
            
            table {
                width: 50%;
            border-collapse: separate; /* Usiamo border-collapse: separate per separare le celle */
            border-spacing: 10px; /* Aggiungiamo spazio tra le celle */
            margin: 20px auto;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border:0;
            }
            th, td {
                border: 1px solid #ccc;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            .cellatabella {
                text-align: center; /* Aggiunto per centrare il contenuto */
            }
            .pilota1 {
                float: left; /* Allinea a sinistra */
                margin-right: 10px; /* Aggiunge spazio tra i piloti */
            }
            .pilota2 {
                float: right; /* Allinea a destra */
                margin-left: 10px; /* Aggiunge spazio tra i piloti */
            }
            .macchinaimg{
                width: 30em;
                height: auto;
            }
            .pilotaimg{
                width: 5em;
                height: auto;
                
                border: 2px solid;
            }
            .logosquadra{
                width: 7em;
                height: auto;
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

            <div class="profilo" onclick="toggleDropdown()">
                <img src="../img/guest_ico.png" alt="profile" class="avatar">

                <div class="dropdown-menu" id="dropdownMenu">
                    <!-- Contenuto del menu a tendina -->
                    <a href="#">Login</a>
                    <a href="#">Subscribe</a>
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

        <main>
            <h1>F1 Teams 2024</h1>

            <table>
                <tr>
                    <td>
                        <div class="cellatabella">
                            <h3>Alpine</h3><img src="../img/loghi/alpinelogo.png" alt="profile" class="logosquadra"> <!-- immagine logo squadra-->
                            <div class="pilota1">
                                <img src="../img/piloti/ocon.png" alt="profile" class="pilotaimg"> <!-- immagine pilota1-->
                                <br>
                                <a href="#">pilota 1</a>
                                
                            </div>
                            <div class="pilota2">
                                <img src="../img/piloti/ocon.png" alt="profile" class="pilotaimg"> <!-- immagine pilota1-->
                                <br>
                                <a href="#">pilota 1</a>
                            </div>
                            <br>
                            <img src="../img/macchine/Alpine.png" alt="profile" class="macchinaimg"> <!-- immagine della macchina-->
                        </div>

                    </td>
                    <td>
                    <div class="cellatabella">
                        <h3>Alpine</h3><img src="../img/loghi/alpinelogo.png" alt="profile" class="logosquadra"> <!-- immagine logo squadra-->
                            <div class="pilota1">
                                <img src="../img/piloti/ocon.png" alt="profile" class="pilotaimg"> <!-- immagine pilota1-->
                                <br>
                                <a href="#">pilota 1</a>
                            </div>
                            <div class="pilota2">
                                <img src="../img/piloti/ocon.png" alt="profile" class="pilotaimg"> <!-- immagine pilota1-->
                                <br>
                                <a href="#">pilota 1</a>
                            </div>
                            <br>
                            <img src="../img/macchine/astonmartin.png" alt="profile" class="macchinaimg"> <!-- immagine della macchina-->
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Riga 2, Cell 1</td>
                    <td>Riga 2, Cell 2</td>
                </tr>
                <tr>
                    <td>Riga 3, Cell 1</td>
                    <td>Riga 3, Cell 2</td>
                </tr>
                <tr>
                    <td>Riga 4, Cell 1</td>
                    <td>Riga 4, Cell 2</td>
                </tr>
                <tr>
                    <td>Riga 5, Cell 1</td>
                    <td>Riga 5, Cell 2</td>
                </tr>
                <tr>
                    <td>Riga 6, Cell 1</td>
                    <td>Riga 6, Cell 2</td>
                </tr>
                <tr>
                    <td>Riga 7, Cell 1</td>
                    <td>Riga 7, Cell 2</td>
                </tr>
                <tr>
                    <td>Riga 8, Cell 1</td>
                    <td>Riga 8, Cell 2</td>
                </tr>
                <tr>
                    <td>Riga 9, Cell 1</td>
                    <td>Riga 9, Cell 2</td>
                </tr>
                <tr>
                    <td>Riga 10, Cell 1</td>
                    <td>Riga 10, Cell 2</td>
                </tr>
            </table>
            
        </main>

        <footer>
            <!-- Contenuto del footer -->
            <p>&copy; Schievano gay</p>
        </footer>

    </body>

</html>