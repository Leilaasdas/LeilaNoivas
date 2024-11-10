<?php
include 'config.php'; // Inclui o arquivo de configuração do banco de dados

// Consulta para recuperar todas as categorias
$sql = "SELECT id, nome FROM categorias";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Categorias</title>
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
    <a href="menu.php" ><button type="button" class="btn_voltar" >Voltar</button></a>
    <h2>Lista de Categorias</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["id"]); ?></td>
                    <td><?php echo htmlspecialchars($row["nome"]); ?></td>
                    <td>
                        <!-- Link para editar a categoria -->
                        <a href="editar_categoria.php?id=<?php echo $row['id']; ?>">Editar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Nenhuma categoria encontrada.</p>
    <?php endif; ?>

    <?php $conn->close(); // Fechar a conexão ?>
    </div>
</body>
</html>
