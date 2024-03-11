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
$Nome = test_input($_POST["pilota"]);

$query = "SELECT * FROM piloti WHERE CodiceP = ?";

// Query SQL per ottenere le news
$stmt = conn->prepare($query);
$stmt->bind_param("s", $Nome);
$stmt->execute();
$result = $stmt->get_result();

// Interazione sui risultati
$row = $result->fetch_assoc();

$querySquadra = "SELECT Nome 
                 FROM contratto 
                    INNER JOIN squadra ON squadra.CodiceS = contratto.CodiceS 
                 WHERE CodiceP =" . $row['CodiceP'] . 
                 "ORDER BY Datacontratto 
                  DESC LIMIT 1;"; 

$resultSquadra = conn->query($querySquadra);
$rowSquadra = $resultSquadra->fetch_assoc();

echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Foto']) . '" alt="' . $row['Nome'] . ' id="img_pilota"">';
echo '<div>';
echo '<h4>Nome: </h4><label for="nome">' . $row['Nome'] . '</label>';
echo '<h4>Cognome: </h4><label for="cognome">' . $row['Cognome'] . '</label>';
echo '<h4>data nascita: </h4> <label for="anno">' . $row['DataNacita'] . '</label>';
echo '<h4>numero: </h4> <label for="numero pilota">' . $row['Numero'] . '</label>';
echo '<h4>squadra: </h4><label for="squadra">' . $rowSquadra['Nome'] . '</label>';
echo '</div>';
// Chiudi la connessione
$conn->close();
?>