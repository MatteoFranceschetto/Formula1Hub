<?php
// Connessione al database
$servername = "127.0.0.1";
$username = "il_tuo_username";
$password = "la_tua_password";
$dbname = "dbformula1hub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Query per ottenere i primi due piloti per ogni squadra divisi per anno
$sql = "SELECT s.Nome AS Squadra, p1.Nome AS Pilota1, p2.Nome AS Pilota2, m.Foto AS Logo, m.CodiceSquadra, p1.Numero AS Numero1, p2.Numero AS Numero2, m.CodiceM
        FROM squadra s
        INNER JOIN macchina m ON s.CodiceS = m.CodiceSquadra
        LEFT JOIN piloti p1 ON s.CodiceS = p1.CodiceSquadra
        LEFT JOIN piloti p2 ON s.CodiceS = p2.CodiceSquadra AND p1.CodiceP <> p2.CodiceP
        ORDER BY s.CodiceS, p1.Numero";

$result = $conn->query($sql);

// Inizializzazione della variabile per tenere traccia dell'anno
$currentYear = null;

// Iterazione sui risultati
while ($row = $result->fetch_assoc()) {
    // Se l'anno cambia, stampa un nuovo titolo (h1)
    if ($currentYear !== $row['AnnoProduzione']) {
        if ($currentYear !== null) {
            echo '</table>'; // Chiudi la tabella precedente
        }
        echo '<h1>Anno ' . $row['AnnoProduzione'] . '</h1>';
        echo '<table>';
        $currentYear = $row['AnnoProduzione'];
    }

    // Stampa una riga della tabella con i dati dei piloti e la macchina
    echo '<tr>';
    echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['Logo']) . '" alt="' . $row['Squadra'] . '"></td>';
    echo '<td>' . $row['Pilota1'] . '<br>Numero: ' . $row['Numero1'] . '</td>';
    echo '<td>' . $row['Pilota2'] . '<br>Numero: ' . $row['Numero2'] . '</td>';
    echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['Foto']) . '" alt="' . $row['Squadra'] . '"></td>';
    echo '</tr>';
}

// Chiudi l'ultima tabella
echo '</table>';

// Chiudi la connessione al database
$conn->close();
?>