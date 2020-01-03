<?php
include_once('Model/Produtos.php');

class PostDAO {

    private $conn;

    public function __construct() {
        $registry = Registro::getInstance();
        $this->conn = $registry->get('Connection');
    }

    public function insert(Produtos $produtos) {
        $this->conn->beginTransaction();

        try {
            $stmt = $this->conn->prepare(
                'INSERT INTO produtos (nome, codigo, valor, tipo_id) VALUES (:nome, :codigo, :valor, :tipo_id)'
            );

            $stmt->bindValue(':nome', $produtos->getNome());
            $stmt->bindValue(':codigo', $produtos->getCodigo());
            $stmt->bindValue(':valor', $produtos->getValor());
            $stmt->bindValue(':tipo_id', $produtos->getTipo());
            $stmt->execute();

            $this->conn->commit();
        }
        catch(Exception $e) {
            $this->conn->rollback();
        }
    }

    public function getAll() {
        $statement = $this->conn->query(
            'SELECT * FROM produtos'
        );

        return $this->processResults($statement);
    }

    private function processResults($statement) {
        $results = array();

        if($statement) {
            while($row = $statement->fetch(PDO::FETCH_OBJ)) {
                $produtos = new Produtos();

                $produtos->setNome($row->nome);
                $produtos->setCodigo($row->codigo);
                $produtos->setValor($row->valor);
                $produtos->setTipo($row->tipo);

                $results[] = $produtos;
            }
        }

        return $results;
    }

}
?>