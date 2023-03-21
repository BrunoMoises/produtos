<?php
require_once("../vendor/autoload.php");

$id = $_GET['id'];

use App\Controller\ImagensController;

$imagensController = new ImagensController();
$imagem = $imagensController->readByImageId($id);
Header("Content-type: image/gif");
echo $imagem;
