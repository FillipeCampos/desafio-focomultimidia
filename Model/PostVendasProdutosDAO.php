<?php
include_once('Model/VendasProdutos.php');

class PostVendasProdutosDAO {

    private $conn;

    public function __construct() {
        $registry = Registro::getInstance();
        $this->conn = $registry->get('Connection');
    }

    public function insert(VendasProdutos $vendas_produtos) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                'INSERT INTO venda_produto (produtos_id, qtd_solicitada) VALUES (:produtos_id, :qtd_solicitada)'
            );

            $stmt->bindValue(':produtos_id', $vendas_produtos->getProdutoId());
            $stmt->bindValue(':qtd_solicitada', $vendas_produtos->getQtdSolicitada());
            $stmt->execute();

            $this->conn->commit();
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    }

    public function getAll() {
        $statement = $this->conn->query(
            'SELECT * FROM venda_produto'
        );

        return $this->processResults($statement);
    }

    private function processResults($statement) {
        $results = array();

        if($statement) {
            while($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $vendas_produtos = new VendasProdutos();

                $vendas_produtos->setProdutoId($row->produtos_id);
                $vendas_produtos->setQtdSolicitada($row->qtd_solicitada);

                $results[] = $vendas_produtos;
            }
        }

        return $results;
    }

}
?>