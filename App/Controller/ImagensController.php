<?php

namespace App\Controller;

use App\Entity\Imagens;
use App\Model\ImagensModel;

class ImagensController
{
    private $imagensModel;
    public function __construct()
    {
        $this->imagensModel = new ImagensModel();
    }

    function readById($id_produto = 0)
    {
        $id_produto = filter_var($id_produto, FILTER_SANITIZE_NUMBER_INT);

        if ($id_produto <= 0)
            return json_encode(["result" => "invalid id"]);

        return $this->imagensModel->readById($id_produto);
    }

    function create($data = null)
    {
        $imagem = $this->convertType($data);
        $result = $this->validate($imagem);

        if ($result != "") {
            return json_encode(["result" => $result]);
        }

        return json_encode(["id" => $this->imagensModel->create($imagem)]);
    }

    function delete($id_imagem = 0)
    {
        $id_imagem = filter_var($id_imagem, FILTER_SANITIZE_NUMBER_INT);

        if ($id_imagem <= 0)
            return json_encode(["result" => "invalid id"]);

        $result = $this->imagensModel->delete($id_imagem);

        return json_encode(["result" => $result]);
    }

    private function convertType($data)
    {
        return new Imagens(
            null,
            (isset($data['produto_id']) ? filter_var($data['produto_id'], FILTER_SANITIZE_NUMBER_INT) : null),
            (isset($data['imagem']) ? filter_var($data['imagem']) : null),
        );
    }

    private function validate(Imagens $imagem, $update = false)
    {
        if ($update && $imagem->getId() <= 0)
            return "invalid id";

        if ($imagem->getProduto_id() <= 0)
            return "invalid produto";

        if ($imagem->getImagem() == "")
            return "invalid imagem";

        return "";
    }
}
