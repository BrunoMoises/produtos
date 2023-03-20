<?php

namespace App\Entity;

class Pedido {
    private $id;
    private $produto_id;
    private $quantidade;

    public function __construct($id = '', $produto_id = '', $quantidade = '')
    {
        $this->id = $id;
        $this->produto_id = $produto_id;
        $this->quantidade = $quantidade;
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

    public function getProduto_id()
    {
        return $this->produto_id;
    }

    public function setProduto_id($produto_id)
    {
        $this->produto_id = $produto_id;

        return $this;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }
}