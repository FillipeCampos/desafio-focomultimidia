<?php
include_once('Model/ProdutosTipo.php');

class PostProdutosTipoDAO {

    private $conn;

    public function __construct() {
        $registry = Registro::getInstance();
        $this->conn = $registry->get('Connection');
    }

    public function insert(ProdutosTipo $produtos_tipo) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                'INSERT INTO produtos_tipo (nome, valor_imposto) VALUES (:nome, :valor_imposto)'
            );

            $stmt->bindValue(':nome', $produtos_tipo->getNome());
            $stmt->bindValue(':valor_imposto', $produtos_tipo->getValorImposto());
            $stmt->execute();

            $this->conn->commit();
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    }

    public function getAll() {
        $statement = $this->conn->query(
            'SELECT * FROM produtos_tipo'
        );

        return $this->processResults($statement);
    }

    private function processResults($statement) {
        $results = array();

        if($statement) {
            while($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $produtos_tipo = new ProdutosTipo();

                $produtos_tipo->setNome($row->nome);
                $produtos_tipo->setValorImposto($row->valor_imposto);

                $results[] = $produtos_tipo;
            }
        }

        return $results;
    }

}
?>