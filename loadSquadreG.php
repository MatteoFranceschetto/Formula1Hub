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

echo '<table id="outer_table">';

// Iterazione sui risultati delle squadre
while ($rowSquadra = $resultSquadre->fetch_assoc()) {
    if ($altern)
        echo '<tr>';
    echo '<td>';

    // Ottieni i primi due piloti per la squadra corrente
    $sqlPiloti = "SELECT piloti.Nome, piloti.Cognome, piloti.Numero, piloti.Foto
                    FROM piloti
                    INNER JOIN contratto ON piloti.CodiceP = contratto.CodiceP
                    WHERE contratto.CodiceS = " . $rowSquadra['CodiceS'] . "
                    ORDER BY contratto.DataContratto
                    LIMIT 2;";

    $resultPiloti = $conn->query($sqlPiloti);

    $sqlMacchina = "SELECT Foto
                   FROM macchina
                   WHERE CodiceSquadra = " . $rowSquadra['CodiceS'] . "
                   ORDER BY AnnoProduzione DESC
                   LIMIT 1;";

    $resultMacchina = $conn->query($sqlMacchina)->fetch_assoc();

    // Iterazione sui risultati dei piloti
    $rowPilota1 = $resultPiloti->fetch_assoc();
    $rowPilota2 = $resultPiloti->fetch_assoc();

    // Stampa un nuovo titolo (h2) per la squadra
    echo '<h2>' . $rowSquadra['Nome'] . '</h2>';

    // Stampa una riga della tabella con i dati dei piloti e la macchina
    echo '<table id="internal_table">';
    echo '<tr>';
    echo '<td>';
    echo '<div class="pilota1">';
    echo '<img class="pilotaimg" src="data:image/jpeg;base64,' . base64_encode($rowPilota1['Foto']) . '" alt="' . $rowPilota1['Nome'] . '">';
    echo '<p>' . $rowPilota1['Nome'] . ' ' . $rowPilota1['Cognome'] . '<br>Numero: ' . $rowPilota1['Numero'] . '</p>';
    echo '</div>';
    echo '</td>';

    echo '<td>';
    echo '<div class="logosquadra">';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($rowSquadra['Logo']) . '" alt="' . $rowSquadra['Nome'] . '">';
    echo '</div>';
    echo '</td>';

    echo '<td>';
    echo '<div class="pilota2">';
    echo '<img class="pilotaimg" src="data:image/jpeg;base64,' . base64_encode($rowPilota2['Foto']) . '" alt="' . $rowPilota2['Nome'] . '">';
    echo '<p>' . $rowPilota2['Nome'] . ' ' . $rowPilota2['Cognome'] . '<br>Numero: ' . $rowPilota2['Numero'] . '</p>';
    echo '</div>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="3">';
    echo '<div class="macchinaimg">';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($resultMacchina['Foto']) . '" alt="' . $rowSquadra['Nome'] . '_Macchina">';
    echo '</div>';
    echo '</td>';
    echo '</tr>';

    echo '</table>';

    echo '</td>';
    if ($altern) {
        echo '</tr>';
    }
    $altern = !$altern;
}

// Chiudi l'ultima tabella
echo '</table>';

// Chiudi la connessione al database
$conn->close();
?>