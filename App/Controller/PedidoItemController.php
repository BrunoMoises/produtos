<?php

namespace App\Controller;

use App\Entity\Pedido_item;
use App\Model\PedidoItemModel;

class PedidoItemController
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
