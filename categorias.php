<?php
include 'config.php'; // Inclua seu arquivo de conexão

// Obter todas as categorias
$result = $conn->query("SELECT id, nome FROM categorias");
$categorias = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
} else {
    echo "Erro ao obter categorias: " . $conn->error; // Mensagem de erro se a consulta falhar
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="item.css">
    <title>Categorias</title>
    <style>
        /* Estilo básico para os botões */
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            color: white;
            background-color: #007BFF; /* Cor do botão */
            border: none;
            border-radius: 5px;
            text-decoration: none; /* Remove o sublinhado do link */
        }
        .button:hover {
            background-color: #0056b3; /* Cor do botão ao passar o mouse */
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
        <?php if (empty($categorias)):?>
            <p>Nenhuma categoria encontrada.</p>
        <?php else:?>
            <ul>
                <?php foreach ($categorias as $categoria):?>
                    <li>
                        <a href="itens_por_categoria.php?id=<?php echo $categoria['id'];?>">
                            <?php echo htmlspecialchars($categoria['nome']);?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
    </div>
</body>
</html>
