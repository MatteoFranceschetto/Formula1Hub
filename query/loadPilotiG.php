<?php
// Connessione al database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "dbformula1hub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}


// Query per ottenere i dati delle squadre
$sqlSquadre = "SELECT CodiceS, Nome, Logo FROM squadra;";
$resultSquadre = $conn->query($sqlSquadre);

$altern = true;

echo '<table>';

// Iterazione sui risultati delle squadre
while ($rowSquadra = $resultSquadre->fetch_assoc()) {
    echo '<div>';
    echo '<h3>' . $rowSquadra['Nome'] . '</h3>';
    echo '<img class=\'logosquadra\' src="data:image/jpeg;base64,' . base64_encode($rowSquadra['Logo']) . '" alt="' . $rowSquadra['Nome'] . '">';
    echo '</div>';
    
    echo '<table>';
    echo '<tr>';

    // Ottieni i primi due piloti per la squadra corrente
    $sqlPiloti = "SELECT piloti.Nome, piloti.Cognome, piloti.Numero, piloti.Foto
                    FROM piloti
                    INNER JOIN contratto ON piloti.CodiceP = contratto.CodiceP
                    WHERE contratto.CodiceSquadra = " . $rowSquadra['CodiceS'] . "
                    ORDER BY contratto.DataContratto
                    LIMIT 2;";

    $resultPiloti = $conn->query($sqlPiloti);

    $resultMacchina = conn->query($sqlMacchina)->fetch_assoc();

    // Iterazione sui risultati dei piloti
    $rowPilota1 = $resultPiloti->fetch_assoc();
    $rowPilota2 = $resultPiloti->fetch_assoc();

    // Stampa una riga della tabella con i dati dei piloti e la macchina
    echo '<td>';
    echo '<img class=\'pilotaimg\' src="data:image/jpeg;base64,' . base64_encode($rowPilota1['Foto']) . '" alt="' . $rowPilota1['Nome'] . '">';
    echo '<label for="nome">' . $rowPilota1['Nome'] . '</label>';
    echo '<label for="cognome">' . $rowPilota1['Cognome'] . '</label>';
    echo '<label for="numero pilota">'. $rowPilota1['Numero'] . '</label>';
    echo '</td>';
    echo '<td>';
    echo '<img class=\'pilotaimg\' src="data:image/jpeg;base64,' . base64_encode($rowPilota2['Foto']) . '" alt="' . $rowPilota2['Nome'] . '">';
    echo '<label for="nome">' . $rowPilota2['Nome'] . '</label>';
    echo '<label for="cognome">' . $rowPilota2['Cognome'] . '</label>';
    echo '<label for="numero pilota">'. $rowPilota2['Numero'] . '</label>';
    echo '</td>';

    echo '</tr>';
    echo '</table>';
}

// Chiudi l'ultima tabella
echo '</table>';

// Chiudi la connessione al database
$conn->close();
?>