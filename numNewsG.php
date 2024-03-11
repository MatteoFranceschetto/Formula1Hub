<?php
// Connesione al database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbformula1hub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione al database
if($conn->connect_error){
    die("Connessione al database fallita" . conn->connect_error);
}

// Funzione per evitare SQL injection
function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Recupera i dati relativi alla news ricercata (assicurandosi di evitare SQL injection)
if(isset($_POST["tipologia"]))
    $tipologia = test_input($_POST["tipologia"]);
if(isset($_POST["testo"]))
    $testo = test_input($_POST["testo"]);

if(isset($tipologia)){
    if(isset($testo)){
        $query = "SELECT CEILING(COUNT(*) / 50) AS NUM_NEWS
                  FROM news
                  WHERE (Titolo LIKE '% ? %' OR Descrizione LIKE '% ? %') AND Codice IN (SELECT Codice 
                                                                                         FROM news{$tipologia})";
    }
    else{
        $query = "SELECT CEILING(COUNT(*) / 50) AS NUM_NEWS
                  FROM news
                  WHERE Codice IN (SELECT Codice 
                                   FROM news{$tipologia})";
    }
}
else if(isset($testo)){
    $query = "SELECT CEILING(COUNT(*) / 50) AS NUM_NEWS
              FROM news
              WHERE Titolo LIKE '% ? %' OR Descrizione LIKE '% ? %'";
}
else{
    $query = "SELECT CEILING(COUNT(*) / 50) AS NUM_NEWS
                  FROM news";
}

// Query SQL per ottenere le news
$stmt = $conn->prepare($query);
if(isset($testo))
    $stmt->bind_param("ss", $testo, $testo);
$stmt->execute();
$result = $stmt->get_result();

// Interazione sui risultati
$row = $result->fetch_assoc();
if($row['NUM_NEWS'] > 0)
    echo $row['NUM_NEWS'];
else
    echo 'Nessuna pagina trovata';

// Chiudi la connessione
$conn->close();
?>