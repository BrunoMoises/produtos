<?php

namespace App\Controller;

use App\Entity\Pedido_item;
use App\Model\PedidoItemModel;

class Pedido_itemController
{
    private $pedidoItemModel;
    public function __construct()
    {
        $this->pedidoItemModel = new PedidoItemModel();
    }

    function create($data = null)
    {
        $pedido_item = $this->convertType($data);
        $result = $this->validate($pedido_item);

        if ($result != "") {
            return json_encode(["result" => $result]);
        }

        return json_encode(["id" => $this->pedidoItemModel->create($pedido_item)]);
    }

    function delete($pedido_id = 0, $produto_id = 0)
    {
        $pedido_id = filter_var($pedido_id, FILTER_SANITIZE_NUMBER_INT);
        $produto_id = filter_var($produto_id, FILTER_SANITIZE_NUMBER_INT);

        if ($pedido_id <= 0 || $produto_id <= 0)
            return json_encode(["result" => "invalid id"]);

        $result = $this->pedidoItemModel->delete($pedido_id, $produto_id);

        return json_encode(["result" => $result]);
    }

    private function convertType($data)
    {
        return new Pedido_item(
            (isset($data['pedido_id']) ? filter_var($data['pedido_id'], FILTER_SANITIZE_NUMBER_INT) : null),
            (isset($data['produto_id']) ? filter_var($data['produto_id'], FILTER_SANITIZE_NUMBER_INT) : null),
            (isset($data['quantidade']) ? filter_var($data['quantidade'], FILTER_SANITIZE_NUMBER_INT) : null),
        );
    }

    private function validate(Pedido_item $pedido_item, $update = false)
    {
        if ($update && $pedido_item->getPedido_id() <= 0)
            return "invalid id";

        if ($pedido_item->getProduto_id() <= 0)
            return "invalid produto";

        if ($pedido_item->getQuantidade() <= 0)
            return "invalid quantidade";

        return "";
    }
}
