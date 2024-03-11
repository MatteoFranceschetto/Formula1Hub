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

// Iterazione sui risultati delle squadre
while ($rowSquadra = $resultSquadre->fetch_assoc()) {

    // Ottieni i primi due piloti per la squadra corrente
    $sqlMacchine = "SELECT Foto, Nome, AnnoProduzione
                    FROM macchina
                    WHERE CodiceSquadra = " . $rowSquadra['CodiceS'] . "
                    ORDER BY AnnoProduzione DESC;";

    $resultMacchine = $conn->query($sqlMacchine);

    // Verifica se ci sono macchine disponibili
    if ($resultMacchine->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<td style='width : 300px'>";
        echo '<div class="scuderia">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($rowSquadra['Logo']) . '" alt="' . $rowSquadra['Nome'] . '">';
        echo '<h3>' . $rowSquadra['Nome'] . '</h3>';
        echo '</div>';
        echo "</td>";
        echo "<td>";
        
        // Inizio della tabella
        echo '<table>';

        // Iterazione sulle macchine
        while ($rowMacchina = $resultMacchine->fetch_assoc()) {
            // Inizio di una nuova riga
            echo '<tr>';

            // Colonna 1: Foto della macchina
            echo '<td>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($rowMacchina['Foto']) . '" alt="' . $rowMacchina['Nome'] . '">';
            echo '</td>';

            // Colonna 2: Nome della macchina (in grassetto)
            echo '<td style="font-weight: bold;">';
            echo $rowMacchina['Nome'];
            echo '</td>';

            // Colonna 3: Anno di produzione (tra parentesi)
            echo '<td>';
            echo '(' . $rowMacchina['AnnoProduzione'] . ')';
            echo '</td>';

            // Fine della riga
            echo '</tr>';
        }

        // Fine della tabella
        echo '</table>';
        echo "</td>";
        echo "</tr>";
        echo "</table>";
    }
}

// Chiudi la connessione al database
$conn->close();
?>