<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itens Adicionados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Itens Adicionados</h1>

        <?php
        // Consulta para recuperar itens
        $sql = "SELECT id, nome, tamanho, quantidade, preco FROM itens";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nome</th><th>Tamanho</th><th>Quantidade</th><th>Preço</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row["id"]) . "</td><td>" . htmlspecialchars($row["nome"]) . "</td><td>" . htmlspecialchars($row["tamanho"]) . "</td><td>" . htmlspecialchars($row["quantidade"]) . "</td><td>R$" . number_format($row["preco"], 2, ',', '.') . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum item encontrado.";
        }

        // Fechar a conexão
        $conn->close();
        ?>
        
        <br><a href='menu.php'>Adicionar Novo Item</a>
    </div>
</body>
</html>
