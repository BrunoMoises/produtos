<?php

namespace App\Entity;

class Pedido
{
    private $id;
    private $valor;

    public function __construct($id = '', $valor = '')
    {
        $this->id = $id;
        $this->valor = $valor;
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

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }
}
