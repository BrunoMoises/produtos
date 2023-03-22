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

        return json_encode($this->imagensModel->readById($id_produto));
    }

    function readByImageId($id = 0)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if ($id <= 0)
            return json_encode(["result" => "invalid id"]);

        return $this->imagensModel->readByImageId($id);
    }

    function create($data = null)
    {
        return $this->imagensModel->create($data);
    }

    function delete($id_imagem = 0)
    {
        $id_imagem = filter_var($id_imagem, FILTER_SANITIZE_NUMBER_INT);

        if ($id_imagem <= 0)
            return json_encode(["result" => "invalid id"]);

        $result = $this->imagensModel->delete($id_imagem);

        return json_encode(["result" => $result]);
    }
}
