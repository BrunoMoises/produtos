<?php

namespace App\Model;

use App\Entity\Pedido_item;
use App\Database\Database;
use Exception;
use mysqli;

class PedidoItemModel
{
    public $database;
    private $db;
    private $items;

    public function __construct()
    {
        
    }

    public function getConnection()
    {
        $this->db = null;
        try {
            $this->db = new mysqli('localhost', 'root', '', 'test');
        } catch (Exception $e) {
            echo "Database could not be connected: " . $e->getMessage();
        }

        return $this->db;
    }

    public function create(Pedido_item $pedido_item)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_pedido = $pedido_item->getPedido_id();
        $this->items->id_produto = $pedido_item->getProduto_id();
        $this->items->quantidade = $pedido_item->getQuantidade();

        return $this->items->addItemPedido();
    }

    public function delete($id_pedido, $id_produto)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_pedido = isset($id_pedido) ? $id_pedido : die();
        $this->items->id_produto = isset($id_produto) ? $id_produto : die();

        return $this->items->deletePedidoItem();
    }
}
