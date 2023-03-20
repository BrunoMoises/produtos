<?php

namespace App\Entity;

class Pedido_item {
    private $pedido_id;
    private $produto_id;
    private $quantidade;

    public function __construct($pedido_id = '', $produto_id = '', $quantidade = '')
    {
        $this->pedido_id = $pedido_id;
        $this->produto_id = $produto_id;
        $this->quantidade = $quantidade;
    }

    public function getPedido_id()
    {
        return $this->pedido_id;
    }

    public function setPedido_id($pedido_id)
    {
        $this->pedido_id = $pedido_id;

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