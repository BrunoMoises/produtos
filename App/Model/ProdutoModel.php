<?php

namespace App\Model;

use App\Entity\Produto;
use App\Database\Database;
use Exception;
use mysqli;

class ProdutoModel
{
    public $database;
    private $db;
    private $items;
    private $images;
    private $listProduto = [];
    private $listImagens = [];

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
        return $this->listProduto;
    }

    public function readById($id_produto)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);
        $this->images = new Database($this->db);

        $this->items->id_produto = $id_produto;
        $this->images->id_produto = $id_produto;
        $this->items->getProdutoById();

        if ($this->items->descricao != null) {

            $records = $this->images->getImagensById();
            $itemCount = $records->num_rows;

            if ($itemCount > 0) {
                while ($row = $records->fetch_assoc()) {
                    array_push($this->listImagens, $row);
                }
                $prod_arr = array(
                    "id_produto" => $this->items->id_produto,
                    "descricao" => $this->items->descricao,
                    "valorVenda" => $this->items->valorVenda,
                    "estoque" => $this->items->estoque,
                    "imagens" => $this->listImagens
                );

                http_response_code(200);

                return json_encode($prod_arr);
            }

            http_response_code(404);
            return json_encode(
                array("message" => "Não encontrado.")
            );
        }
    }

    public function create(Produto $produto)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->descricao = $produto->getDescricao();
        $this->items->valorVenda = $produto->getValorVenda();
        $this->items->estoque = $produto->getEstoque();

        return $this->items->createProduto();
    }


    public function update(Produto $produto)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_produto = $produto->getId();
        $this->items->descricao = $produto->getDescricao();
        $this->items->valorVenda = $produto->getValorVenda();
        $this->items->estoque = $produto->getEstoque();

        return $this->items->updateProduto();
    }

    public function delete($id_produto)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_produto = isset($id_produto) ? $id_produto : die();

        return $this->items->deleteProduto();
    }

    private function load()
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $records = $this->items->getProdutos();
        $itemCount = $records->num_rows;

        if ($itemCount > 0) {
            while ($row = $records->fetch_assoc()) {
                array_push($this->listProduto, $row);
            }
        } else {
            http_response_code(404);
            return json_encode(
                array("message" => "Não encontrado.")
            );
        }
    }
}
