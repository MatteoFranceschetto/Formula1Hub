<?php
// Connessione al database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbformula1hub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione al database
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Funzione per evitare SQL injection
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Recupera i dati dalla registrazione (assicurandosi di evitare SQL injection)
$nome = test_input($_POST["nome"]);
$cognome = test_input($_POST["cognome"]);
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);


// Query SQL per verificare se lo stesso username è già presente
$checkUsernameQuery = "SELECT CodiceU FROM utenti WHERE username = ?";
$checkUsernameStmt = $conn->prepare($checkUsernameQuery);
$checkUsernameStmt->bind_param("s", $username);
$checkUsernameStmt->execute();
$existingUser = $checkUsernameStmt->get_result()->fetch_assoc();

// Verifica se lo stesso username è già presente
if ($existingUser) {
    echo "Username già in uso. Scegliere un altro username.";
} else {
    // Se lo username non è già presente, procedi con l'inserimento
    $insertQuery = "INSERT INTO utenti (Nome, Cognome, username, password) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ssss", $nome, $cognome, $username, $password);

    // Esegui l'inserimento e restituisci una risposta
    if ($insertStmt->execute()) {
        echo "Registrazione completata con successo";
    } else {
        echo "Errore durante la registrazione";
    }
}

$checkUsernameStmt->close();
$insertStmt->close();
$conn->close();
?>