<?php

namespace App\Model;

use App\Entity\Pedido;
use App\Database\Database;
use Exception;
use mysqli;

class PedidoModel
{
    public $database;
    private $db;
    private $items;
    private $listPedido = [];
    private $listProdutos = [];

    public function __construct()
    {
        $this->load();
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

    public function readAll()
    {
        return $this->listPedido;
    }

    public function readById($id_pedido)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_pedido = $id_pedido;

        $records = $this->items->getPedidoById();
        $itemCount = $records->num_rows;

        if ($itemCount > 0) {
            while ($row = $records->fetch_assoc()) {
                array_push($this->listProdutos, $row);
            }
        } else {
            http_response_code(404);
            return json_encode(
                array("message" => "Não encontrado.")
            );
        }

        return $this->listProdutos;
    }

    public function create(Pedido $pedido)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->valor = $pedido->getValor();

        return $this->items->createPedido();
    }

    public function delete($id_pedido)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_pedido = isset($id_pedido) ? $id_pedido : die();

        return $this->items->deletePedido();
    }

    private function load()
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $records = $this->items->getPedidos();
        $itemCount = $records->num_rows;

        if ($itemCount > 0) {
            while ($row = $records->fetch_assoc()) {
                array_push($this->listPedido, $row);
            }
        } else {
            http_response_code(404);
            return json_encode(
                array("message" => "Não encontrado.")
            );
        }
    }
}
