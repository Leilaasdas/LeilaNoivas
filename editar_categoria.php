<?php
include 'config.php'; // Inclui o arquivo de configuração do banco de dados

// Habilita relatórios de erros e exceções estritas
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Verifica se o ID foi enviado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera a categoria atual
    $sql = "SELECT nome FROM categorias WHERE id=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception($conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $categoria = $result->fetch_assoc();
        $nome_categoria_atual = htmlspecialchars($categoria['nome']);
    } else {
        die("Categoria não encontrada.");
    }
} else {
    die("ID não fornecido.");
}

// Processa a exclusão da categoria e seus itens
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    try {
        // Inicia uma transação
        $conn->begin_transaction();

        // Exclui os itens associados à categoria
        $deleteItensSql = "DELETE FROM itens WHERE id_categoria=?";
        $deleteItensStmt = $conn->prepare($deleteItensSql);
        if (!$deleteItensStmt) {
            throw new Exception($conn->error);
        }
        $deleteItensStmt->bind_param("i", $delete_id);
        if (!$deleteItensStmt->execute()) {
            throw new Exception($deleteItensStmt->error);
        }

        // Exclui a categoria
        $deleteSql = "DELETE FROM categorias WHERE id=?";
        $deleteStmt = $conn->prepare($deleteSql);
        if (!$deleteStmt) {
            throw new Exception($conn->error);
        }
        $deleteStmt->bind_param("i", $delete_id);
        if (!$deleteStmt->execute()) {
            throw new Exception($deleteStmt->error);
        }

        // Se tudo ocorrer bem, confirma a transação
        $conn->commit();
        
        echo "<script>alert('Categoria e itens excluídos com sucesso!'); window.location.href='listar_categorias.php';</script>";
    } catch (Exception $e) {
        // Em caso de erro, reverte a transação
        $conn->rollback();
        echo "<script>alert('Erro ao excluir categoria ou itens: ". htmlspecialchars($e->getMessage()). "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
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

        .img {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h2 {
            text-align: center;
            margin: 0;
            font-size: 20px;
        }

        /* Form Styles */
        form {
            width: 95%;
            margin-top: 5px;
            padding: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="number"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #404040c8;
            border-radius: 4px;
        }

        input:focus, input:active, button:focus, button:active {
            outline: none;
            background-color: #eaeaea62; /* Exemplo de cor de fundo */
            box-shadow: 0 0 5px #dadada; /* Exemplo de sombra */
        }

        button[type="submit"] {
            background-color: #b0784a;
            color: #ffffff;
            padding: 10px 20px;
            border: 2px solid transparent;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            width: 35%;
        }

        button[type="submit"]:hover {
            background-color: transparent;
            color: #000000;
            border: 2px solid #b0784a;
        }

        /* Delete Button Styles */
        button[type="submit"][style="background-color:red;color:white;"] {
            background-color:red;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;}
        
         button[type="submit"][style="background-color:red;color:white;"]:hover {background-color:#8b0a0a;}

         /* Link Styles */
         a {
             padding-left:45%;
             text-decoration:none;color:#073964;font-size:20px;}
        
         a:hover {color:#23527c;}
     </style>
</head>
<body>
<div class="img">
<div class="container">
<h2>Editar Categoria</h2>

<form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id);?>">
    
    <label for="nome">Nome da Categoria:</label><br>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome_categoria_atual);?>" required><br><br>

    <button type="submit">Atualizar Item</button> 
</form>

<form action="" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
    <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($id);?>">
    <button type="submit" style="background-color:red;color:white;">Excluir Categoria</button>
</form>

<a href="listar_categorias.php">Cancelar</a>

</div>

<?php $conn->close(); // Fechar a conexão?>
</body>
</html>
