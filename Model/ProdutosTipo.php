<?php
class ProdutosTipo{

    private $nome;
    private $valor_imposto;

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getValorImposto() {
        return $this->valor_imposto;
    }

    public function setValorImposto($valor) {
        $this->valor_imposto = $valor;
        return $this;
    }

}
?>