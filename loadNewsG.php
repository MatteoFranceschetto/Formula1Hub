<?php
// Connesione al database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbformula1hub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione al database
if($conn->connect_error){
    die("Connessione al database fallita" . $conn->connect_error);
}

// Funzione per evitare SQL injection
function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Recupera i dati relativi alla news ricercata (assicurandosi di evitare SQL injection)
if(isset($_POST["numero_pagina"]))
    $page = (intval(test_input($_POST["numero_pagina"])) - 1) * 50;
else
    $page = 0;
if(isset($_POST["tipologia"]))
    $tipologia = test_input($_POST["tipologia"]);
if(isset($_POST["testo"]))
    $testo = test_input($_POST["testo"]);

if(isset($tipologia)){
    if(isset($testo)){
        $query = "SELECT CodiceN
                  FROM news
                  WHERE (Titolo LIKE '% ? %' OR Descrizione LIKE '% ? %') AND CodiceN IN (SELECT CodiceN 
                                                                                         FROM news{$tipologia})
                  ORDER BY DataP
                  LIMIT 50
                  OFFSET ?;";
    }
    else{
        $query = "SELECT CodiceN
                  FROM news
                  WHERE CodiceN IN (SELECT CodiceN 
                                   FROM news{$tipologia})
                  ORDER BY DataP
                  LIMIT 50
                  OFFSET ?;";
    }
}
else if(isset($testo)){
    $query = "SELECT CodiceN
              FROM news
              WHERE Titolo LIKE '% ? %' OR Descrizione LIKE '% ? %'
              ORDER BY DataP
              LIMIT 50
              OFFSET ?;";
}
else{
    $query = "SELECT CodiceN
                  FROM news
                  ORDER BY DataP
                  LIMIT 50
                  OFFSET ?;";
}

// Query SQL per ottenere le news
$stmt = $conn->prepare($query);
if(isset($testo))
    $stmt->bind_param("ss", $testo, $testo);
$stmt->bind_param("s", $page);
$stmt->execute();
$result = $stmt->get_result();

// Interazione sui risultati
while($row = $result->fetch_assoc()) {
    $query_sec = "SELECT Titolo, SUBSTRING(Descrizione, 1, 131) AS Descrizione
                  FROM news
                  WHERE CodiceN =" . $row['CodiceN'] . ";";

    $subRow = $conn->query($query_sec)->fetch_assoc();

    echo '<div><a onclick="redirect_news(' . $row['CodiceN'] .')>
          <h3>' . $subRow['Titolo'] . '</h3>
          <p>' . (mb_strlen($subRow['Descrizione']) > 130 ? $subRow['Descrizione'] . "..." : $subRow['Descrizione']) . '</p></a></div>';
}

// Chiudi la connessione
$conn->close();
?>