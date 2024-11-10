<?php
include 'config.php'; // Inclui o arquivo de configuração do banco de dados

// Verifica se o ID da categoria foi passado na URL
if (isset($_GET['id_categoria'])) {
    $categoria_id = $_GET['id_categoria'];

    // Validação do ID da categoria
    if (filter_var($categoria_id, FILTER_VALIDATE_INT) === false) {
        echo "<script>alert('ID inválido!'); window.location.href='selecionar_categoria.php';</script>";
        exit;
    }

    // Consulta para recuperar os itens da categoria selecionada
    $sql = "SELECT id, nome, tamanho, quantidade, preco FROM itens WHERE id_categoria=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    echo "<script>alert('ID da categoria não fornecido!'); window.location.href='selecionar_categoria.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    
    <title>Editar Itens - Leila Noivas</title>

    <style>
        body {
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    margin: 0;
    padding: 0;
    background-color: #f7e9e2c4;
}

.container {
    width: 60%;
    height: auto;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    border: 4px outset #b0784a;
    border-radius: 10px;
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.352);
}

.img{
    margin-top: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.btn_voltar {
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    background-color: #b0784a;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    padding: 5px 12px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn_voltar:hover {
background-color: transparent;
color: black;
border: 1px solid #b0784a;
}

.btn_voltar:active {
/* Efeito de pressionamento do botão */
transform: scale(0.95);
}

/* style.css */

/* Global Styles */

/* Header Styles */
h2 {
    color: #000000;
    margin-top: 0;
    text-align: center;
    font-size: 20px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #000000;
    padding: 5px;
    text-align: center;
}

th {
    color: #fff;
    background-color: #b0784a;
}

td {
    
}

/* Table Header Styles */
th:first-child, td:first-child {
    width: 10%;
}

th:nth-child(2), td:nth-child(2) {
    width: 30%;
}

th:nth-child(3), td:nth-child(3) {
    width: 15%;
}

th:nth-child(4), td:nth-child(4) {
    width: 15%;
}

th:nth-child(5), td:nth-child(5) {
    width: 15%;
}

th:nth-child(6), td:nth-child(6) {
    width: 15%;
}

/* Link Styles within Table */
td a {
    text-decoration: none;
    color: #337ab7;
}

td a:hover {
    color: #23527c;
}

/* No Items Message */
.container p {
    font-size: 20px;
    color: #ff0000;
    text-align: center;
}



    </style>
</head>
<body>
    <div class="img">
        <img src="img/logo leila_noiva.png" alt="logo">
    </div>
    <div class="container">
    <a href="selecionar_categoria.php" ><button type="button" class="btn_voltar" >Voltar</button></a>
        <h2>Itens da categoria selecionada</h2>

        <?php if ($result->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tamanho</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["nome"]); ?></td>
                        <td><?php echo htmlspecialchars($row["tamanho"]); ?></td>
                        <td><?php echo htmlspecialchars($row["quantidade"]); ?></td>
                        <td>R$<?php echo number_format($row["preco"], 2, ',', '.'); ?></td>
                        <td>
                            <!-- Link para editar o item -->
                            <a href="editar_item.php?id=<?php echo $row['id']; ?>">Editar</a> 
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Nenhum item encontrado nesta categoria.</p>
        <?php endif; ?>

    </div>

    <?php $conn->close(); // Fechar a conexão ?>
</body>
</html>
