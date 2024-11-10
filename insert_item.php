<?php
include 'config.php';

// Obter categorias do banco de dados
$result = $conn->query("SELECT id, nome FROM categorias");
$categorias = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $id_categoria = $_POST['id_categoria']; // Captura o ID da categoria selecionada

    // Preparar a consulta SQL
    $stmt = $conn->prepare("INSERT INTO itens (nome, tamanho, quantidade, preco, id_categoria) VALUES (?,?,?,?,?)");
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: ". $conn->error);
    }

    // Vincular os parâmetros
    $stmt->bind_param("ssisi", $nome, $tamanho, $quantidade, $preco, $id_categoria);

    // Executar a consulta
    if ($stmt->execute()) {
       ?>
        <div class="success-message">
            <p>Novo item adicionado com sucesso!</p>
            <a href="insert_item.php">Adicionar outro item</a>
            <a href="categorias.php">Ver Itens Adicionados</a>
        </div>
        <?php
    } else {
       ?>
        <div class="error-message">
            <p>Erro ao adicionar item: <?php echo $stmt->error;?></p>
        </div>
        <?php
    }

    // Fechar a declaração
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="item.css">
    <title>Adicionar Item</title>
    <link rel="stylesheet" href="add_item.css">
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
  
.img{
    margin-top: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    
}

h1 {
    text-align: center;
    margin: 0;
    font-size: 25px;
}

form {
    width: 95%;
    margin-top: 5px;
    padding: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input, select {
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



input[type="submit"] {
    background-color: transparent;
    color: #000000;
    padding: 10px 20px;
    border: 2px solid #b0784a;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
    width: 30%;
    display: flex;
 
    margin: auto;
}

input[type="submit"]:hover {
    background-color: #7a5542;
    color: #fff;
    border: none;
}

/* Estilos para mensagens de sucesso ou erro */
.success-message,.error-message {
    padding: 10px;
    border-radius: 5px;
    width: 90%;
    display: flex;
    justify-content: space-around;
    margin: 50px auto;
   
}

.success-message {
    background-color: #6bff54; /* Cor de fundo verde claro */
    padding: 10px;
  /* Cor da borda verde escuro */
    border-radius: 5px;
    
}

.success-message p {
    color: #000000; /* Cor do texto verde escuro */
    font-weight: bold;
}

.success-message a {
    height: 30px;
    margin: 15px;
    text-decoration: none;
    color: #2f89ff; /* Cor do link verde escuro */
    font-weight: bold;
    justify-items: center;
    text-justify: auto;
}

.success-message a:hover {
    color: #000000;
}

.error-message {
    background-color: #F8D7DA; /* Cor de fundo vermelho claro */
    padding: 10px;
   /* Cor da borda vermelho escuro */
    border-radius: 5px;
    margin-bottom: 10px;
}

.error-message p {
    color: #721C24; /* Cor do texto vermelho escuro */
    font-weight: bold;
}
    </style>
</head>
<body>
    <div class="img">
        <img src="img/logo leila_noiva.png" alt="logo">
    </div>
    <div class="container">
        <a href="menu.php" ><button type="button" class="btn_voltar" >Voltar</button></a>
        <h1>Adicionar Novo Item</h1>
        <form method="post" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>
            <label for="tamanho">Tamanho:</label>
            <input type="text" id="tamanho" name="tamanho" required><br>
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" required><br>
            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" required><br>
            <label for="id_categoria">Categoria:</label>
            <select id="id_categoria" name="id_categoria" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['id']; ?>"><?php echo htmlspecialchars($categoria['nome']); ?></option>
                <?php endforeach; ?>
            </select><br>
            <input type="submit" value="Adicionar">
        </form>
    </div>
</body>
</html>
