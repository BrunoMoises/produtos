<?php

namespace App\Database;

class Database
{
    private $db;
    private $table_produto = "produto";
    private $table_pedido = "pedido";
    private $table_pedido_itm = "pedido_item";
    private $table_imagens = "imagens";
    public $id_produto;
    public $descricao;
    public $valorVenda;
    public $estoque;
    public $id_pedido;
    public $valor;
    public $quantidade;
    public $id_imagem;
    public $imagem;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /*---------------------------------------------------
                    PRODUTOS
---------------------------------------------------*/
    public function getProdutos()
    {
        $sqlQuery = "SELECT * FROM " . $this->table_produto;
        return $this->db->query($sqlQuery);
    }

    public function getProdutoById()
    {
        $sqlQuery = "SELECT descricao, valorVenda, estoque FROM " . $this->table_produto . " WHERE id = " . $this->id_produto;
        $record = $this->db->query($sqlQuery);
        $dataRow = $record->fetch_assoc();
        $this->descricao = $dataRow['descricao'];
        $this->valorVenda = $dataRow['valorVenda'];
        $this->estoque = $dataRow['estoque'];
    }

    public function createProduto()
    {
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->valorVenda = htmlspecialchars(strip_tags($this->valorVenda));
        $this->estoque = htmlspecialchars(strip_tags($this->estoque));
        $sqlQuery = "INSERT INTO " . $this->table_produto . " (descricao,valorVenda,estoque) 
                            VALUES ('" . $this->descricao . "','" . $this->valorVenda . "','" . $this->estoque . "')";
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return mysqli_insert_id($this->db);
        }
        return false;
    }

    public function updateProduto()
    {
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->valorVenda = htmlspecialchars(strip_tags($this->valorVenda));
        $this->estoque = htmlspecialchars(strip_tags($this->estoque));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));

        $sqlQuery = "UPDATE " . $this->table_produto . " 
                    SET descricao = '" . $this->descricao . "',
                        valorVenda = '" . $this->valorVenda . "',
                        estoque = '" . $this->estoque . "'
                    WHERE id = " . $this->id_produto;

        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    function deleteProduto()
    {
        $sqlQuery = "DELETE FROM " . $this->table_produto . " WHERE id = " . $this->id_produto;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    /*---------------------------------------------------
                    PEDIDOS
---------------------------------------------------*/
    public function getPedidos()
    {
        $sqlQuery = "SELECT id, valor
                    FROM " . $this->table_pedido;
        return $this->db->query($sqlQuery);
    }

    public function getPedidoById()
    {
        $sqlQuery = "SELECT p.descricao, 
                            ped.quantidade, 
                            p.valorVenda, 
                            (p.valorVenda * ped.quantidade) totalProduto 
                    FROM " . $this->table_pedido_itm . " ped
                    INNER JOIN produto p ON p.id = ped.produto_id
                    WHERE id = " . $this->id_pedido;
        return $this->db->query($sqlQuery);
    }

    public function createPedido()
    {
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $sqlQuery = "INSERT INTO " . $this->table_pedido . " (valor) 
                            VALUES ('" . $this->valor . "')";
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return mysqli_insert_id($this->db);
        }
        return false;
    }

    public function addItemPedido()
    {
        $this->id_pedido = htmlspecialchars(strip_tags($this->id_pedido));
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->quantidade = htmlspecialchars(strip_tags($this->quantidade));
        $sqlQuery = "INSERT INTO " . $this->table_pedido_itm . " (pedido_id, produto_id, quantidade) 
                            VALUES ('" . $this->id_pedido . "','" . $this->id_produto . "','" . $this->quantidade . "')";
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            $this->updatePedido($this->id_pedido, $this->quantidade);
            return true;
        }
        return false;
    }

    public function updatePedido($id_pedido, $quantidade)
    {
        $this->id_pedido = $id_pedido;
        $this->getProdutoById();
        $this->valor = $this->valorVenda * $quantidade;

        $sqlQuery = "UPDATE " . $this->table_pedido . " 
                    SET valor = valor + " . $this->valor . "
                    WHERE id = " . $this->id_pedido;

        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    function deletePedido()
    {
        $sqlQuery = "DELETE FROM " . $this->table_pedido_itm . " WHERE pedido_id = " . $this->id_pedido;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            $sqlQuery = "DELETE FROM " . $this->table_pedido . " WHERE id = " . $this->id_pedido;
            $this->db->query($sqlQuery);
            if ($this->db->affected_rows > 0) {
                return true;
            }
        }
        return false;
    }

    /*---------------------------------------------------
                    IMAGENS
---------------------------------------------------*/
    public function getImagensById()
    {
        $sqlQuery = "SELECT *
                        FROM " . $this->table_imagens . " 
                        WHERE produto_id = " . $this->id_produto;
        return $this->db->query($sqlQuery);
    }

    public function createImagem()
    {
        $this->id_produto = htmlspecialchars(strip_tags($this->id_produto));
        $this->imagem = htmlspecialchars(strip_tags($this->imagem));
        $nomeFinal = time() . '.jpg';
        if (move_uploaded_file($this->imagem['tmp_name'], $nomeFinal)) {
            $tamanhoImg = filesize($nomeFinal);

            $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));

            $sqlQuery = "INSERT INTO " . $this->table_imagens . " (produto_id,imagem) VALUES ('" . $this->id_produto . "','$mysqlImg')";
            $this->db->query($sqlQuery);
            if ($this->db->affected_rows > 0) {
                unlink($nomeFinal);
                return true;
            }
            return false;
        }
    }

    function deleteImagem()
    {
        $this->id_imagem = htmlspecialchars(strip_tags($this->id_imagem));
        $sqlQuery = "DELETE FROM " . $this->table_imagens . " WHERE id = " . $this->id_imagem;
        $this->db->query($sqlQuery);
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}
