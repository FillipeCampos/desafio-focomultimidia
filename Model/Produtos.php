<?php
class Produtos{

    private $nome;
    private $codigo;
    private $valor;
    private $tipo_id;

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($content) {
        $this->codigo = $content;
        return $this;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($content) {
        $this->valor = $content;
        return $this;
    }

    public function getTipo() {
        return $this->tipo_id;
    }

    public function setTipo($content) {
        $this->tipo_id = $content;
        return $this;
    }

}
?>