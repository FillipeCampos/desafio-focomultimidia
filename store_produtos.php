<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if(isset($_POST["nome_tipo_produto"])) {

      include_once('Model/Registro.php');
      include_once('Model/PostProdutosTipoDAO.php');
      include_once('Model/ProdutosTipo.php');

      $nome_tipo_produto = $_POST["nome_tipo_produto"];
      $valor_imposto_produto = $_POST["valor_imposto_produto"];

      // Instanciar uma conexão com PDO
      $conn = new PDO(
          'mysql:host=10.10.1.70;port=3306;dbname=fillipe_desafio', 'root', 'root'
      );
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Armazenar essa instância no Registro
      $registro = Registro::getInstance();
      $registro->set('Connection', $conn);

      // Instanciar um novo Produto e setar informações
      $produto_tipo = new ProdutosTipo();
      $produto_tipo->setNome($nome_tipo_produto);
      $produto_tipo->setValorImposto($valor_imposto_produto);

      // Instanciar o DAO e trabalhar com os métodos
      $postDAO = new PostDAO();
      $postDAO->insert($produto_tipo);
   }

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
</head>
<body>

<form action="store_vendas_produtos.php" method="post">
    <label for="nome_produto">Nome do Produto</label>
    <input type="text" name="nome_produto"><br/>

    <label for="codigo_produto">Código</label>
    <input type="text" name="codigo_produto"><br/>

    <label for="valor_produto">Valor</label>
    <input type="text" name="valor_produto"><br/>

    <label for="tipo_produtos_id">Tipo</label>
    <input type="text" name="tipo_produtos_id"><br/>
    <input type="submit" value="Submit">
</form>

</body>
</html>