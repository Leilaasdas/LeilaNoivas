<?php
include 'config.php'; // Inclua seu arquivo de conexão

// Verificar se o ID da categoria foi passado
if (isset($_GET['id'])) {
    $id_categoria = intval($_GET['id']); // Obter o ID da categoria

    // Obter itens da categoria selecionada
    $stmt = $conn->prepare("SELECT nome, tamanho, quantidade, preco FROM itens WHERE id_categoria =?");
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se há itens
    if ($result->num_rows > 0) {
        $items = "
            <table class='item-table'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tamanho</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
        ";
        while ($row = $result->fetch_assoc()) {
            $items.= "
                <tr>
                    <td>". htmlspecialchars($row['nome'])."</td>
                    <td>". htmlspecialchars($row['tamanho'])."</td>
                    <td>". htmlspecialchars($row['quantidade'])."</td>
                    <td>R$ ". htmlspecialchars(number_format($row['preco'], 2, ',', '.'))."</td>
                </tr>
            ";
        }
        $items.= "
                </tbody>
            </table>
        ";
    } else {
        $items = "<h1 class='no-items'>Nenhum item encontrado nesta categoria.</h1>";
    }

    // Fechar a declaração
    $stmt->close();
} else {
    $items = "<h1 class='no-category-id'>ID da categoria não fornecido.</h1>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itens por Categoria</title>
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

        /* Estilos para a tabela de itens */
       .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

       .item-table th,.item-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

       .item-table th { 
        color:#fff;
            background-color: #b0784a;
        }

       .item-table td {
            background-color: #ffffff;
        }

        /* Estilos para a mensagem de nenhum item encontrado */
       .no-items {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        /* Estilos para a mensagem de ID da categoria não fornecido */
       .no-category-id {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="img">
        <img src="img/logo leila_noiva.png" alt="logoleilanoiva">
    </div>
    <div class="container">
        <h2>Itens na categoria</h2>
        <a href="categorias.php" ><button type="button" class="btn_voltar" >Voltar</button></a>
        <div class="item-list">
            <?= $items?>
        </div>
    </div>
</body>
</html>
