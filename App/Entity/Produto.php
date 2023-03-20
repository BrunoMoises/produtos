<?php

namespace App\Entity;

class Produto
{
    private $id;
    private $descricao;
    private $valorVenda;
    private $estoque;
    private $imagens;

    public function __construct($id = '', $descricao = '', $valorVenda = '', $estoque = '', $imagens = '')
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->valorVenda = $valorVenda;
        $this->estoque = $estoque;
        $this->imagens = $imagens;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getValorVenda()
    {
        return $this->valorVenda;
    }

    public function setValorVenda($valorVenda)
    {
        $this->valorVenda = $valorVenda;

        return $this;
    }

    public function getEstoque()
    {
        return $this->estoque;
    }

    public function setEstoque($estoque)
    {
        $this->estoque = $estoque;

        return $this;
    }

    public function getImagens()
    {
        return $this->imagens;
    }

    public function setImagens($imagens)
    {
        $this->imagens = $imagens;

        return $this;
    }
}
