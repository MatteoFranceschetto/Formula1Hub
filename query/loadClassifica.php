<?php
    // Connessione al database
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
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Data attuale
    $data_attuale = date("Y-m-d");

    // Variabile per tenere traccia dell'anno precedente
    $anno_precedente = null;

    // Query per ottenere i CodiceG delle gare già avvenute
    $query_gare_avvenute = "SELECT CodiceG, NomeC, Giorno FROM gara 
                            WHERE Giorno <= '$data_attuale'
                            ORDER BY CodiceG ASC";

    // Esecuzione della query per le gare avvenute
    $stmt_gare_avvenute = $conn->query($query_gare_avvenute);

    // Inizio della tabella
    echo '<table>';
    while($result = $stmt_gare_avvenute->fetch_assoc()){
        $codice_g = $result['CodiceG'];

        // Ottenere l'anno dalla data
        $anno_corrente = date('Y', strtotime($result['Giorno']));

        // Se l'anno è diverso dal precedente, stampa il nuovo anno
        if ($anno_corrente != $anno_precedente) {
            echo "<tr><th colspan='2'>Anno $anno_corrente</th></tr>";
            $anno_precedente = $anno_corrente;
        }

        // Titolo con il valore di CodiceG
        echo "<tr><td colspan='2'><strong>".$result['NomeC']."</strong> - <strong>". $result['Giorno']."</strong></td></tr>";

        // Query per ottenere i piloti per questo CodiceG
        $piloti_query = "SELECT Nome, Cognome, p.Posizione FROM piloti 
            INNER JOIN partecipazione p on p.CodiceP=piloti.CodiceP 
            WHERE p.CodiceG = '$codice_g'
            ORDER BY p.Posizione;";

        // Esecuzione della query per i piloti
        $piloti_stmt = $conn->query($piloti_query);

        // Creazione della tabella per i piloti
        while($piloti_result = $piloti_stmt->fetch_assoc()){
            echo '<tr>';
            echo '<td>'.$piloti_result["Posizione"].'</td>';
            echo '<td>'.$piloti_result["Nome"]." ".$piloti_result["Cognome"].'</td>';
            echo '</tr>';
        }
    }
    echo '</table>';
    

    // Chiudi la connessione
    $conn->close();
?>
