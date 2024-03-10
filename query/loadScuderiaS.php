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
$Nome = test_input($_POST["scuderia"]);

$query = "SELECT * FROM squadra WHERE Nome = ?";

// Query SQL per ottenere le news
$stmt = conn->prepare($query);
$stmt->bind_param("s", $Nome);
$stmt->execute();
$result = $stmt->get_result();

// Interazione sui risultati
$row = $result->fetch_assoc();

$queryPiloti = "SELECT Nome, Foto 
                 FROM contratto 
                    INNER JOIN piloti ON piloti.CodiceP = contratto.CodiceP
                 WHERE CodiceS =" . $row['CodiceS'] . 
                 "ORDER BY Datacontratto 
                  DESC LIMIT 2;"; 

$resultPiloti = conn->query($queryPiloti);
$rowPiloti1 = $resultPiloti->fetch_assoc();
$rowPiloti2 = $resultPiloti->fetch_assoc();

$queryDirettori ="SELECT Nome, Cognome, Foto
                  FROM staff
                  WHERE Ruolo IN('Direttore Sportivo','Direttore Tecnico') AND CodiceSquadra =" . $row['CodiceS'] .
                  "ORDER BY Ruolo LIMIT 2;";

$resultDirettori = conn->query($queryPiloti);
$rowDirettore1 = $resultDirettori->fetch_assoc();
$rowDirettore2 = $resultDirettori->fetch_assoc();

echo '<div>';
echo '<img src="data:image/jpeg;base64,' . base64_encode($row['Logo']) . '" alt="' . $row['Nome'] . ' id="img_squadra">';
echo '<h1>' . $row['Nome'] . '</h1>';
echo '</div>';
echo '<teble>';
echo '<tr>';
echo '<td>';
echo '<h4>Sede: </h4><label for="sede">' . $row['Sede'] . '</label>';
echo '<h4>Power Unit: </h4> <label for="PU">' . $row['Power Unit'] . '</label>';
echo '<div id="direttoreS">';
echo '<label for="direttoreS">' . $rowDirettore1['Nome'] . '</label>';
echo '<img src="data:image/jpeg;base64,' . base64_encode($rowDirettore1['Foto']) . '" alt="' . $rowDirettore1['Nome'] . ' id="img_Direttore">';
echo '</div>';
echo '<div id="direttoreT">';
echo '<label for="direttoreS">' . $rowDirettore2['Nome'] . '</label>';
echo '<img src="data:image/jpeg;base64,' . base64_encode($rowDirettore2['Foto']) . '" alt="' . $rowDirettore2['Nome'] . ' id="img_Direttore">';
echo '</div>';
echo '</td>';
echo '<td>';
echo '<div id="Pilota1">';
echo '<label for="direttoreS">' . $rowPiloti1['Nome'] . '</label>';
echo '<img src="data:image/jpeg;base64,' . base64_encode($rowPiloti1['Foto']) . '" alt="' . $rowPiloti1['Nome'] . ' id="img_Pilota1">';
echo '</div>';
echo '<div id="Pilota2">';
echo '<label for="Pilota2">' . $rowPiloti2['Nome'] . '</label>';
echo '<img src="data:image/jpeg;base64,' . base64_encode($rowPiloti2['Foto']) . '" alt="' . $rowPiloti2['Nome'] . ' id="img_Pilota2">';
echo '</div>';
echo '</td>';
echo '</tr>';
echo '</table>';
echo '<br><br>';
echo '<div>';
echo '<h3>Riguardo la Scuderia</h3>';
echo '<p>' . $row['Descrizione'] . '</p>';

// Chiudi la connessione
$conn->close();
?>