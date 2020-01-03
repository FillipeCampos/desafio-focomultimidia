<?php
class VendasProdutos{

    private $produtos_id;
    private $qtd_solicitada;

    public function getProdutoId() {
        return $this->produtos_id;
    }

    public function setProdutoId($produto_id) {
        $this->produtos_id = $produto_id;
        return $this;
    }

    public function getQtdSolicitada() {
        return $this->qtd_solicitada;
    }

    public function setQtdSolicitada($qtd) {
        $this->qtd_solicitada = $qtd;
        return $this;
    }

}
?>