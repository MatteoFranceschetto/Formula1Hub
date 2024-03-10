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

$myUser = json_decode($_POST["JSON"], true);
$username = $myUser['username'];
$password = $myUser['password'];

$query = "SELECT CodiceU AS
            FROM utenti
            WHERE Username = $username AND Password = $password";



// Query SQL per ottenere le news
$stmt = conn->prepare($query);
$stmt->execute();
$CodiceU = $stmt->get_result()->fetch_assoc();

// Interazione sui risultati
$QuerySquadre = "SELECT CodiceS
                 FROM preferiti
                 WHERE CodiceU =" . $CodiceU["CodiceU"];
$resultSquadre = $conn->query($QuerySquadre);

if ($resultSquadre->num_rows > 0) {
    echo '<table border="1">';

    // Elabora ogni risultato della prima query
    while ($rowSquadre = $resultSquadre->fetch_assoc()) {
        $CodiceS = $rowSquadre['CodiceS'];

        // Esegui la seconda query utilizzando il CodiceS ottenuto dalla prima query
        $QueryPreferiti = "SELECT Nome, Logo, PowerUnit
                           FROM Squadre
                           WHERE CodiceS =" . $CodiceS;
        $resultPreferiti = $conn->query($QueryPreferiti);

        if ($resultPreferiti->num_rows > 0) {
            // Mostra i risultati all'interno della tabella
            while ($rowPreferiti = $resultPreferiti->fetch_assoc()) {
                echo '<div>';
                // Mostra l'immagine BLOB
                echo '<p align="center"><img src="data:image/jpeg;base64,' . base64_encode($rowPreferiti['Logo']) . '" alt="Logo"></p>';
                echo '<p align="center">' . $rowPreferiti['Nome'] . '</p>';
                echo '<p align="center"><i>' . $rowPreferiti['PowerUnit'] . '</i></p>';
                echo '</div>';
            }
        }
    }
} else {
    echo "Nessuna squadra tra i Preferiti.";
}

// Chiudi la connessione al database
$conn->close();
?>