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

// Iterazione sui risultati delle squadre
while ($rowSquadra = $resultSquadre->fetch_assoc()) {
    echo '<div class="team-container">';
    echo '<div>';
    echo '<img class="team-logo" src="data:image/jpeg;base64,' . base64_encode($rowSquadra['Logo']) . '" alt="' . $rowSquadra['Nome'] . '">';
    echo '<h3>' . $rowSquadra['Nome'] . '</h3>';
    echo '</div>';

    echo '<div class="pilot-container">';
    
    // Ottieni i primi due piloti per la squadra corrente
    $sqlPiloti = "SELECT piloti.Nome, piloti.Cognome, piloti.Numero, piloti.Foto
                    FROM piloti
                    INNER JOIN contratto ON piloti.CodiceP = contratto.CodiceP
                    WHERE contratto.CodiceS = " . $rowSquadra['CodiceS'] . "
                    ORDER BY contratto.DataContratto
                    LIMIT 2;";

    $resultPiloti = $conn->query($sqlPiloti);
    
    echo '<table><tr>';
    // Iterazione sui risultati dei piloti
    while ($rowPilota = $resultPiloti->fetch_assoc()) {
        echo '<td>';
        echo '<div class="pilot">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($rowPilota['Foto']) . '" alt="' . $rowPilota['Nome'] . '">';
        echo '<label for="nome">' . $rowPilota['Nome'] . ' ' . $rowPilota['Cognome'] . '</label>';
        echo '<label for="numero">Numero: ' . $rowPilota['Numero'] . '</label>';
        echo '</div>';
        echo '</td>';
    }
    echo '</tr></table>';

    echo '</div>'; // Chiude .pilot-container

    echo '</div>'; // Chiude .team-container
}

// Chiudi la connessione al database
$conn->close();
?>