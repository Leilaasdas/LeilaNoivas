<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leila Noivas - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        
*{
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    margin: 0;
    padding: 0;
}

body {
   
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f7e9e2c4;
}

img{
    padding-bottom: 10%;
}

.container {
    text-align: center;
}

.login-box {
    background-color: #fff;
    padding: 50px;
    border: 4px outset #b0784a;
    border-radius: 10px;
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.352);
}

.login-box h2 {
    color: #000000; 
    margin-bottom: 30px;
}

.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group label {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #000000;
}

.input-group input {
    width: 100%;
    padding: 12px 15px;
    padding-left: 40px; /* Espaço para o ícone */
    border: 1px solid #000000;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"] {
    background-color: transparent; 
    border: 3px outset #b0784a;
    color: rgb(0, 0, 0);
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: 600;
    width: 30%;
}

button[type="submit"]:hover {
    background-color: #7a5542;
    color: #fff;
    border: none;
 }

.to_link{
    padding-top: 30px;
    display: flex;
    flex-direction: column;
    text-align: left;
}
.links{
    padding: 3px;
}
    </style>
    <script>
        function validarLogin(event) {
            event.preventDefault(); // Impede o envio do formulário

            // Obtém os valores dos campos
            const matricula = document.getElementById('matricula').value;
            const senha = document.getElementById('password').value;

            // Credenciais corretas
            const matriculaCorreta = '01700933';
            const senhaCorreta = '123';

            // Verifica se as credenciais estão corretas
            if (matricula === matriculaCorreta && senha === senhaCorreta) {
                alert("Login bem-sucedido!");
                window.location.href = "menu.php"; // Redireciona para a página estoque.php
            } else {
                alert("Matrícula ou senha incorretas. Tente novamente.");
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <img src="img/logo leila_noiva.png" alt="logo">
        <div class="login-box">
            <h2>Login</h2>
            <form onsubmit="validarLogin(event)"> <!-- Chamando a função de validação -->
                <div class="input-group">
                    <label for="matricula">
                        <i class="fas fa-user"></i> 
                    </label>
                    <input type="text" id="matricula" placeholder="Digite sua matrícula" required> <!-- Alterado para matrícula -->
                </div>
                <div class="input-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" id="password" placeholder="Digite a sua senha" required>
                </div>
                <button type="submit">Entrar</button> <!-- Botão de envio -->
            </form>
        </div>
    </div>
</body>
</html>
