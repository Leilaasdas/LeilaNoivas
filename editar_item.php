<?php
include 'config.php'; // Inclui o arquivo de configuração do banco de dados

// Verifica se o ID do item foi passado na URL
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Validação do ID
    if (filter_var($item_id, FILTER_VALIDATE_INT) === false) {
        echo "<script>alert('ID inválido!'); window.location.href='selecionar_categoria.php';</script>";
        exit;
    }

    // Consulta para recuperar os dados do item
    $sql = "SELECT nome, tamanho, quantidade, preco FROM itens WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $item = $result->fetch_assoc();
    } else {
        echo "<script>alert('Item não encontrado!'); window.location.href='selecionar_categoria.php';</script>";
        exit;
    }

} else {
    echo "<script>alert('ID não fornecido!'); window.location.href='selecionar_categoria.php';</script>";
    exit;
}

// Processa o formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == 'update') {
        // Atualiza o item no banco de dados
        $nome = $_POST['nome'];
        $tamanho = $_POST['tamanho'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];

        $updateSql = "UPDATE itens SET nome=?, tamanho=?, quantidade=?, preco=? WHERE id=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssddi", $nome, $tamanho, $quantidade, $preco, $item_id);

        if ($updateStmt->execute()) {
            echo "<script>alert('Item atualizado com sucesso!'); window.location.href='selecionar_categoria.php';</script>"; 
            exit;
        } else {
            echo "<script>alert('Erro ao atualizar item: " . htmlspecialchars($updateStmt->error) . "');</script>";
        }
    } elseif ($_POST['action'] == 'delete') {
        // Exclui o item do banco de dados
        $deleteSql = "DELETE FROM itens WHERE id=?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $item_id);

        if ($deleteStmt->execute()) {
            echo "<script>alert('Item excluído com sucesso!'); window.location.href='selecionar_categoria.php';</script>"; 
            exit;
        } else {
            echo "<script>alert('Erro ao excluir item: " . htmlspecialchars($deleteStmt->error) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Item - Leila Noivas</title>
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
    -moz-outline-style: none;
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
button[type="submit"][style="background-color: red; color: white;"] {
    background-color: red;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"][style="background-color: red; color: white;"]:hover {
    background-color: #8b0a0a;
}

/* Link Styles */
a {
    padding-left: 45%;
    text-decoration: none;
    color: #073964;
    font-size: 20px;
}

a:hover {
    color: #23527c;
}


    </style>
</head>
<body>
<div class="img">
        <img src="img/logo leila_noiva.png" alt="logo">
    </div>
<div class="container">
<h2>Editar Item</h2>

<form action="" method="POST">
   <!-- Campos para editar -->
   <label for="nome">Nome:</label>
   <input type="text" name="nome" value="<?php echo htmlspecialchars($item['nome']); ?>" required>

   <label for="tamanho">Tamanho:</label>
   <input type="text" name="tamanho" value="<?php echo htmlspecialchars($item['tamanho']); ?>" required>

   <label for="quantidade">Quantidade:</label>
   <input type="number" name="quantidade" value="<?php echo htmlspecialchars($item['quantidade']); ?>" required>

   <label for="preco">Preço:</label>
   <input type="number" step="0.01" name="preco" value="<?php echo htmlspecialchars($item['preco']); ?>" required>

   <input type="hidden" name="action" value="update">
   <button type="submit">Atualizar Item</button> 
   <a href="selecionar_categoria.php">Cancelar</a> <!-- Link para voltar à lista -->
</form>

<!-- Formulário para excluir o item -->
<form action="" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
   <input type="hidden" name="action" value="delete">
   <button type="submit" style="background-color: red; color: white;">Excluir Item</button>
</form>

</div>

<?php 
$conn->close(); // Fechar a conexão 
?>
</body>
</html>
