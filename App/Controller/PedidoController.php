<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Model\PedidoModel;

class PedidoController
{
    private $pedidoModel;
    public function __construct()
    {
        $this->pedidoModel = new PedidoModel();
    }
    function create($data = null)
    {
        $pedido = $this->convertType($data);
        $result = $this->validate($pedido);

        if ($result != "") {
            return json_encode(["result" => $result]);
        }

        return json_encode(["id" => $this->pedidoModel->create($pedido)]);
    }

    function delete($id_pedido = 0)
    {
        $id_pedido = filter_var($id_pedido, FILTER_SANITIZE_NUMBER_INT);

        if ($id_pedido <= 0)
            return json_encode(["result" => "invalid id"]);
        $result = $this->pedidoModel->delete($id_pedido);

        return json_encode(["result" => $result]);
    }

    function readById($id = 0)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if ($id <= 0)
            return json_encode(["result" => "invalid id"]);

        return json_encode($this->pedidoModel->readById($id));
    }

    function readAll()
    {
        return json_encode($this->pedidoModel->readAll());
    }

    private function convertType($data)
    {
        return new Pedido(
            null,
            (isset($data['valor']) ? filter_var($data['valor'], FILTER_SANITIZE_NUMBER_FLOAT) : null)
        );
    }

    private function validate(Pedido $pedido, $update = false)
    {
        if ($update && $pedido->getId() <= 0)
            return "invalid id";

        if ($pedido->getValor() <= 0)
            return "invalid valor";

        return "";
    }
}
