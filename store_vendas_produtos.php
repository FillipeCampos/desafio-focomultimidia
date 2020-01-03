<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // echo $_POST["user"];

    include_once('Model/Registro.php');
    include_once('Model/PostVendasProdutosDAO.php');
    include_once('Model/PostDAO.php');
    include_once('Model/VendasProdutos.php');
    include_once('Model/Produtos.php');
    include_once('Model/ProdutosTipo.php');

    // Instanciar uma conexão com PDO
    $conn = new PDO(
        'mysql:host=localhost;port=3306;dbname=fillipe_desafio', 'user', 'password'
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["nome_produto"])) {

        $nome_produto = $_POST["nome_produto"];
        $codigo_produto = $_POST["codigo_produto"];
        $valor_produto = $_POST["valor_produto"];
        $tipo_produtos_id = $_POST["tipo_produtos_id"];

        // Instanciar uma conexão com PDO
        $conn = new PDO(
            'mysql:host=10.10.1.70;port=3306;dbname=fillipe_desafio', 'root', 'root'
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Armazenar essa instância no Registro
        $registro = Registro::getInstance();
        $registro->set('Connection', $conn);

        // Instanciar um novo Produto e setar informações
        $produto = new Produtos();
        $produto->setNome($nome_produto);
        $produto->setCodigo($codigo_produto);
        $produto->setValor($valor_produto);
        $produto->setTipo($tipo_produtos_id);

        // Instanciar o DAO e trabalhar com os métodos
        $postDAO = new PostDAO();
        $postDAO->insert($produto);

    } else {
        $registro = Registro::getInstance();
        $registro->set('Connection', $conn);

        // Instanciar uma nova venda e setar informações
        $vendas_produtos = new VendasProdutos();
        $vendas_produtos->setProdutoId('T1');
        $vendas_produtos->setQtdSolicitada('T1');

        // Instanciar o DAO e trabalhar com os métodos
        $postDAO = new PostVendasProdutosDAO();
        $postDAO->insert($vendas_produtos);

        // Resgatar todos os registros e iterar
        $total_valor_item = 0;
        $total_valor_imposto = 0;

        $results = $postDAO->getAll();
        foreach($results as $vendas_produto) {

            // Busca o produto
            $produto_id = $_POST["produto_id"];
            $qtd_solicitada = $_POST["qtd_solicitada"];
            $produto = Produtos::find($produto_id);
            $total_valor_item += (float) $produto->getValor();

            // Busca o tipo do produto
            $produto_tipo = ProdutosTipo::find($produto->tipo_id);
            $total_valor_imposto += (float) $produto_tipo->getValorImposto();


            echo "Produto: ".$produto->getNome() ."| Qtd: ".$vendas_produto->getQtdSolicitada() .'<br />';
            echo  '<br />';
            echo "Valor Produto: ".$produto->getValor() . '<br />';
            echo "Valor Imposto: ".$produto_tipo->getValorImposto() . '<br /><br /><br /><br />';
        }

        echo "=====================================================================";

        echo "<h2>"."Valor Total de Compra: "."</h2>".$total_valor_item."<br/>";
        echo "<h2>"."Valor Total Imposto: "."</h2>".$total_valor_imposto."<br/>";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tela</title>
</head>
<body>
  <form action="store_vendas_produtos.php" method="post">
    <input type="text" name="produto_id"><br/>
    <input type="text" name="qtd_solicitada"><br/>
    <input type="submit" value="Submit">
  </form>

</body>
</html>