<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Leila Noivas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/menucss.css">
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
    transform: scale(0.95);
}

.menu{
    margin: 20px;
}

.btn{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: auto;
    margin-top: 3%;
    width: 45%;
    height: 75px;
    color: #000;
    font-weight: 600;
    border: 2px solid #000000;
    border-radius: 5px;
    background-color: #fff4ec;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.158);
}

.btn:hover{
    background-color: #b0784a;
    border: 2px solid #b0784a;
    color: #fff;
    transition: 0.5s;
    scale: 1.1;
}
    </style>
    
</head>
<body>
    <div class="img">
        <img src="img/logo leila_noiva.png" alt="logoleilanoiva">
    </div>
    <div class="container">
        <div class="menu">
            <a href="index.php" ><button type="button" class="btn_voltar" >Sair</button></a>
            <button  onclick="window.location.href='insert_item.php'" class="btn" >Adicionar novo item</button>
            <button onclick="window.location.href='selecionar_categoria.php'" class="btn" >Editar itens</button>
            <button onclick="window.location.href='add_categorias.php'" class="btn" >Adicionar categoria</button>
            <button onclick="window.location.href='listar_categorias.php'" class="btn" >Editar categoria</button>
            <button onclick="window.location.href='categorias.php'" class="btn" >Lista de categorias</button>
            
        </div>
    </div>
</body>
</html>
