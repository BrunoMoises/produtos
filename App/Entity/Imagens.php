<?php

namespace App\Entity;

class Imagens
{
    private $id;
    private $produto_id;
    private $imagem;

    public function __construct($id = '', $produto_id = '', $imagem = '')
    {
        $this->id = $id;
        $this->produto_id = $produto_id;
        $this->imagem = $imagem;
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

    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }
}
