<?php
$servername = "localhost";
$username = "root";
$password = ""; // ou sua senha do XAMPP/WAMP
$dbname = "sistema_notas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
