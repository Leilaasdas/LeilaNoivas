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
    <title>Selecionar Categoria</title>
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

/* Header Styles */
h2 {
    text-align: center;
    color: #000000;
    margin-top: 0;
}

/* List Styles */
ul {
    list-style: none;
    padding-left: 0;
}

li {
    display: flex;
    justify-content: center;
    margin: auto;
    margin-top: 3%;
    
}

li a {
    text-align: center;

    text-decoration: none;
    color: #000;
    width: 50%;
    height: auto;
    padding: 20px;
    font-weight: 600;
    border: 2px solid #000000;
    border-radius: 5px;
    background-color: #fff4ec;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.158);
}

li a:hover {
    background-color: #b0784a;
    border: 2px solid #b0784a;
    color: #fff;
    transition: 0.5s;
    scale: 1.1;
}

/* Link Styles */
a {
    text-decoration: none;
    color: #337ab7;
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
    transform: scale(0.95);
}

    </style>
</head>
<body>
<div class="img">
        <img src="img/logo leila_noiva.png" alt="logoleilanoiva">
    </div>
    <div class="container">
        <h2>Selecione a categoria</h2>
        <a href="menu.php" ><button type="button" class="btn_voltar" >Voltar</button></a>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while($row = $result->fetch_assoc()): ?>
                    <li>
                        <a href="editar_itens.php?id_categoria=<?php echo $row['id']; ?>">
                            <?php echo htmlspecialchars($row['nome']); ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>Nenhuma categoria encontrada.</p>
        <?php endif; ?>

    </div>

    <?php $conn->close(); // Fechar a conexão ?>
</body>
</html>
