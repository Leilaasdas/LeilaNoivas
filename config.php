<?php
$servername = "autorack.proxy.rlwy.net"; // Endereço do servidor
$username = "root"; // Nome de usuário
$password = "awpLltgfQoAmyiSbEeGwwFfuflWChVTX"; // Senha
$dbname = "railway"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname, 33612); // Adicione a porta aqui

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>
