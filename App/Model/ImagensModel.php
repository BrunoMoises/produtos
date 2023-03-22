<?php

namespace App\Model;

use App\Entity\Imagens;
use App\Database\Database;
use Exception;
use mysqli;

class ImagensModel
{
    public $database;
    private $db;
    private $items;
    private $listImagens = [];

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

    public function readById($id_produto)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_produto = $id_produto;

        $records = $this->items->getImagensById();
        $itemCount = $records->num_rows;

        if ($itemCount > 0) {
            while ($row = $records->fetch_assoc()) {
                $blob = $row['imagem'];
                $base64 = base64_encode($blob);
                $row['imagem'] = $base64;
                array_push($this->listImagens, $row);
            }
        }

        return $this->listImagens;
    }

    public function readByImageId($id)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_imagem = $id;

        $records = $this->items->getImagemByImageId();
        $row = $records->fetch_assoc();

        return $row['imagem'];
    }

    public function create(Imagens $imagem)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_produto = $imagem->getProduto_id();
        $this->items->imagem = $imagem->getImagem();

        return $this->items->createImagem();
    }

    public function delete($id_imagem)
    {
        $this->db = $this->getConnection();
        $this->items = new Database($this->db);

        $this->items->id_imagem = isset($id_imagem) ? $id_imagem : die();

        return $this->items->deleteImagem();
    }
}
