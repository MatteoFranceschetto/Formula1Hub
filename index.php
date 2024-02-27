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


        <style>
            .login-container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .login-container h2 {
            text-align: center;
        }
        .login-container label {
            display: block;
            margin-bottom: 5px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container input[type="button"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .login-container input[type="button"] {
            background: red;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .login-container input[type="button"]:hover {
            background: darkred;
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
                <p><img src="img/Logo.png" class="logo"> FORMULA 1 HUB</p>
            </div>

            <div class="profilo" onclick="toggleDropdown()">
                <img src="img/guest_ico.png" alt="profile" class="avatar">

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
        <div class="login-container">
            <h2>Login</h2>
            <form action="/your-login-endpoint" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <input type="button" value="Login">
            </form>
        </div>
               

        <div class="login-container">
            <h2>Registrazione</h2>
            <form action="/your-login-endpoint" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="cognome">Cognome:</label>
                <input type="text" id="cognome" name="cognome" required>
                <label for="username">Username:</label>
                <input type="text" id="regUsername" name="regUsername" required>
                <label for="password">Password:</label>
                <input type="password" id="regPassword" name="regPasseord" required>
                <input type="button" value="Registrati">
            </form>
        </div>
      

            <!-- Dove va il testo della pagina -->
            
        </main>

        <footer>
            <!-- Contenuto del footer -->
            <p>&copy; Schievano gay</p>
        </footer>

    </body>

</html>