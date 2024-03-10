<?php
session_start();

// Controlla se l'utente è autenticato
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo json_encode(['username' => $username]);
} else {
    echo json_encode(['error' => 'Utente non autenticato']);
}
?>