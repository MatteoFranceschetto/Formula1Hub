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
$page = (intval(test_input($_POST["numero_pagina"])) - 1) * 50;
$tipologia = test_input($_POST["tipologia"]);
$testo = test_input($_POST["testo"]);

if(isset($tipologia)){
    if(isset($testo)){
        $query = "SELECT Codice, Titolo, Descrizione
                  FROM news
                  WHERE (Titolo LIKE '% ? %' OR Descrizione LIKE '% ? %') AND Codice IN (SELECT Codice 
                                                                                         FROM news{$tipologia})
                  ORDER BY DataP
                  LIMIT 50
                  OFFSET ?;";
    }
    else{
        $query = "SELECT Codice, Titolo, Descrizione
                  FROM news
                  WHERE Codice IN (SELECT Codice 
                                   FROM news{$tipologia})
                  ORDER BY DataP
                  LIMIT 50
                  OFFSET ?;";
    }
}
else if(isset($testo)){
    $query = "SELECT Codice, Titolo, Descrizione
              FROM news
              WHERE Titolo LIKE '% ? %' OR Descrizione LIKE '% ? %'
              ORDER BY DataP
              LIMIT 50
              OFFSET ?;";
}
else{
    $query = "SELECT Codice, Titolo, Descrizione
                  FROM news
                  ORDER BY DataP
                  LIMIT 50
                  OFFSET ?;";
}

// Query SQL per ottenere le news
$stmt = conn->prepare($query);
if(isset($testo))
    $stmt->bind_param("ss", $testo, $testo);
$stmt->bind_param("s", $page);
$stmt->execute();
$result = $stmt->get_result();

// Interazione sui risultati
while($row = $result->fetch_assoc()) {
    echo '<div><a onclick="redirect_news(' . $row['Codice'] .')">
          <h3>' . $row['Titolo'] . '</h3>
          <p>' . (srelen($row['Descrizione']) > 130 ? substr($row['Descrizione'], 0, 130) . "..." : $row['Descrizione']) . '</p></a></div>';
}

// Chiudi la connessione
$conn->close();
?>