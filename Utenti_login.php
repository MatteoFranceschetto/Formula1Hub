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

// Recupera i dati dall'utente (assicurandosi di evitare SQL injection)
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);

// Query SQL per verificare l'utente e la password
$sql = "SELECT Nome, Cognome FROM utenti WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se l'utente esiste e la password è corretta
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Login riuscito. Benvenuto, " . $row["Nome"] . " " . $row["Cognome"];
} else {
    echo "Credenziali non valide";
}

$stmt->close();
$conn->close();
?>