<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Tipo de Produtos</title>
</head>
<body>

<h2>Informe o Tipo do Produto</h2>

<form action="store_produtos.php" method="post">
    <label for="nome_tipo_produto">Nome do Tipo</label>
    <input type="text" name="nome_tipo_produto"><br/>

    <label for="valor_imposto_produto">Valor do Imposto</label>
    <input type="text" name="valor_imposto_produto"><br/>
    <input type="submit" value="Submit">
</form>

</body>
</html>