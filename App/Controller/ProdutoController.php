<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Model\ProdutoModel;

class ProdutoController
{
    private $produtoModel;
    public function __construct()
    {
        $this->produtoModel = new ProdutoModel();
    }
    function create($data = null)
    {
        $produto = $this->convertType($data);
        $result = $this->validate($produto);

        if ($result != "") {
            return json_encode(["result" => $result]);
        }

        return json_encode(["id" => $this->produtoModel->create($produto)]);
    }

    function update($id_produto = 0, $data = null)
    {
        $produto = $this->convertType($data);
        $produto->setId($id_produto);
        $result = $this->validate($produto, true);

        if ($result != "") {
            return json_encode(["result" => $result]);
        }


        $result = $this->produtoModel->update($produto);

        return json_encode(["result" => $result]);
    }

    function delete($id = 0)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if ($id <= 0)
            return json_encode(["result" => "invalid id"]);

        $result = $this->produtoModel->delete($id);

        return json_encode(["result" => $result]);
    }

    function readById($id = 0)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if ($id <= 0)
            return json_encode(["result" => "invalid id"]);

        return $this->produtoModel->readById($id);
    }

    function readAll()
    {
        return json_encode($this->produtoModel->readAll());
    }

    private function convertType($data)
    {
        return new Produto(
            null,
            (isset($data['descricao']) ? filter_var($data['descricao'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null),
            (isset($data['valor']) ? filter_var($data['valor'], FILTER_SANITIZE_NUMBER_FLOAT) : null),
            (isset($data['estoque']) ? filter_var($data['estoque'], FILTER_SANITIZE_NUMBER_INT) : null),
        );
    }

    private function validate(Produto $produto, $update = false)
    {
        if ($update && $produto->getId() <= 0)
            return "invalid id";

        if ($produto->getDescricao() == "")
            return "invalid descricao";

        if ($produto->getValorVenda() <= 0)
            return "invalid valor";

        if ($produto->getEstoque() <= 0)
            return "invalid estoque";

        return "";
    }
}
