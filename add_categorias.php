<?php
 require 'config.php';

// Processar o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_categoria = $_POST['nome_categoria'];

    // Preparar e vincular
    $stmt = $conn->prepare("INSERT INTO categorias (nome) VALUES (?)");
    $stmt->bind_param("s", $nome_categoria);

    // Executar a consulta
    if ($stmt->execute()) {
        $message = "Nova categoria adicionada com sucesso!";
        $class = "success";
    } else {
        $message = "Erro: ". $stmt->error;
        $class = "error";
    }

    // Fechar a declaração
    $stmt->close();
}
?>
<!-- Exibir a mensagem -->
<div class="<?php echo isset($class)? $class : '';?>">
    <?php echo isset($message)? $message : '';?>
</div>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Categoria</title>
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


/* Estilo para a mensagem de sucesso */
.success {
    background-color: #C6F4D6; /* Verde claro */
    color: black;
    padding: 10px;
    margin-top: 10px;
    font-weight: bold;
}

/* Estilo para a mensagem de erro */
.error {
    background-color: #F8D7DA; /* Vermelho claro */
    color: #721C24; /* Vermelho escuro */
    padding: 10px;
    margin-top: 10px;
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
        <h2>Adicionar Nova Categoria</h2>
        <form method="post" action="">
            <label for="nome_categoria">Nome da Categoria:</label>
            <input type="text" id="nome_categoria" name="nome_categoria" required>
            <input type="submit" value="Adicionar">
        </form>
    </div>
</body>
</html>
